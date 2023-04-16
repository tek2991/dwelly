<?php

namespace App\Http\Livewire\Audit;

use Livewire\Component;
use App\Actions\Helpers\UpdateTaskState;

class CompleteChecklist extends Component
{
    public $editable;
    public $auditChecklist;
    public $confirm;
    public $err;

    public function mount($auditChecklist)
    {
        $this->auditChecklist = $auditChecklist;
        $this->confirm = $auditChecklist->completed;
        $this->editable = $this->auditChecklist->audit->completed == false && $this->auditChecklist->completed == false;
    }

    public function rules()
    {
        return [
            'confirm' => 'required|accepted',
        ];
    }

    public function complete()
    {
        $this->validate();

        $this->auditChecklist->update([
            'completed' => true,
        ]);

        // emit
        $this->emit('refreshAuditChecklistCompletion');
        $this->editable = false;

        // update task state
        $this->updateTaskState();

        // redirect to audit show
        return redirect()->route('audit.show', $this->auditChecklist->audit->id);
    }

    public function updateTaskState()
    {
        $task = $this->auditChecklist->audit->task;
        // Update the task state
        UpdateTaskState::update($task, 2);
    }

    public function render()
    {
        return view('livewire.audit.complete-checklist');
    }
}

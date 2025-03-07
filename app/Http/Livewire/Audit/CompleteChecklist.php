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
    public $next_checklist_item_exists = false;

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

        // CHeck if auditChecklist has atleast one uploaded file
        if ($this->auditChecklist->uploads->count() == 0) {
            $this->err = 'Please upload atleast one file before completing the checklist.';
            return;
        }

        $this->auditChecklist->update([
            'completed' => true,
        ]);

        // emit
        $this->emit('refreshAuditChecklistCompletion');
        $this->editable = false;

        // update task state
        $this->updateTaskState();

        $this->routeTo();
    }

    public function routeTo()
    {
        $next_item_exists = $this->auditChecklist->audit->auditChecklists->where('completed', false)->first() !== null;

        if ($next_item_exists) {
            $next_item = $this->auditChecklist
                ->audit
                ->auditChecklists
                ->where('completed', false)
                ->skip(1)  // Skip the first item, to get the next incomplete item
                ->first();
            return redirect()->route('auditChecklist.show', $next_item);
        }

        return redirect()->route('audit.edit', $this->auditChecklist->audit->id);
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

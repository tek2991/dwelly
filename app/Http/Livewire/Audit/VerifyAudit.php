<?php

namespace App\Http\Livewire\Audit;

use Livewire\Component;
use App\Actions\Helpers\UpdateTaskState;

class VerifyAudit extends Component
{
    public $editable = false;
    public $audit;
    public $task;
    public $confirm;
    public $err;

    public function mount($audit)
    {
        $this->audit = $audit;
        $this->task = $audit->task;
        $this->confirm = $audit->completed;
        $this->editable = $this->audit->completed == false && $this->task->task_state_id < 3 ? true : false;
    }

    public function rules()
    {
        return [
            'confirm' => 'required|accepted',
        ];
    }

    public function verify()
    {
        $this->validate();

        if($this->audit->completed) {
            $this->err = 'Audit already completed.';
            return;
        }

        if($this->task->task_state_id != 2) {
            $this->err = 'Task is not in progress.';
            return;
        }

        $auditChecklists_completed = $this->audit->auditChecklists->pluck('completed')->all();

        if (in_array(false, $auditChecklists_completed)) {
            $this->err = 'Please complete all checklist items before completing the audit.';
            return;
        }

        if(!$this->audit->property_id) {
            $this->err = 'Please assign a property to the audit before completing it.';
            return;
        }

        // $this->audit->update([
        //     'completed' => true,
        // ]);

        // update task state
        $this->updateTaskState();

        // emit
        $this->emit('refreshAuditCompletion');

        $this->editable = false;
    }

    public function updateTaskState()
    {
        $task = $this->task;
        // Update the task state
        UpdateTaskState::update($task, 3);
    }


    public function render()
    {
        return view('livewire.audit.complete-audit');
    }
}

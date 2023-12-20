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
        $this->editable = $this->audit->completed == false && $this->task->task_state_id < 4 ? true : false;
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

        if ($this->audit->completed) {
            $this->err = 'Audit already completed.';
            return;
        }

        if ($this->task->task_state_id != 3) {
            $this->err = 'Task is not in the correct state to be completed.';
            return;
        }

        $auditChecklists_completed = $this->audit->auditChecklists->pluck('completed')->all();

        if (in_array(false, $auditChecklists_completed)) {
            $this->err = 'Please complete all checklist items before completing the audit.';
            return;
        }

        $auditChecklists_verified = $this->audit->auditChecklists->pluck('verified')->all();

        if (in_array(false, $auditChecklists_verified)) {
            $this->err = 'Please verify all checklist items before completing the audit.';
            return;
        }

        if (!$this->audit->property_id) {
            $this->err = 'Please assign a property to the audit before completing it.';
            return;
        }

        $this->audit->update([
            'completed' => true,
        ]);

        // update task state
        $this->updateTaskState();

        // Update if onboarding audit
        $this->updateIfOnboarding();

        // emit
        $this->emit('refreshAuditCompletion');

        $this->editable = false;
    }

    public function updateTaskState()
    {
        $task = $this->task;
        // Update the task state
        UpdateTaskState::update($task, 4);
    }

    public function updateIfOnboarding()
    {
        if ($this->audit->auditType->name == 'Property Onboarding') {
            $onboarding = $this->audit->onboarding;

            if (!$onboarding) {
                $this->err = 'Onboarding not found.';
                return;
            }

            $onboarding->update([
                'completed' => true,
            ]);
            
            $onboarding->task->complete();
        }
    }


    public function render()
    {
        return view('livewire.audit.verify-audit');
    }
}

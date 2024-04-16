<?php

namespace App\Http\Livewire\Audit;

use App\Actions\Helpers\UpdateTaskState;
use App\Models\Audit;
use Livewire\Component;
use App\Models\AuditType;

class AuditDescription extends Component
{
    public $task;
    public $audit;
    public $auditTypes;

    public $description;

    public $editable = false;
    public $editing = false;
    public $updated = false;
    public $readonly = false;

    public $onboarding_audit_type_id;
    public $deboarding_audit_type_id;
    public $move_in_audit_type_id;
    public $move_out_audit_type_id;
    public $operational_audit_type_id;
    public $err = null;

    public function mount(Audit $audit, $readonly = false)
    {
        $this->audit = $audit;
        $this->task = $audit->task;
        $this->auditTypes = AuditType::all();

        $this->description = $audit->description;

        $audit_types = $this->auditTypes->pluck('id', 'name')->toArray();

        $this->onboarding_audit_type_id = $audit_types['Property Onboarding'];
        $this->deboarding_audit_type_id = $audit_types['Property De-boarding'];
        $this->move_in_audit_type_id = $audit_types['Move In'];
        $this->move_out_audit_type_id = $audit_types['Move Out'];
        $this->operational_audit_type_id = $audit_types['Operational'];

        $this->readonly = $readonly;
        $this->editable = $this->audit->completed === false && $this->audit->audit_type_id !== $this->operational_audit_type_id && $readonly != true && $this->task->task_state_id < 3 ? true : false;
    }

    protected function rules()
    {
        return [
            'audit.description' => 'required',
        ];
    }

    public function update()
    {
        $this->validate();

        $this->audit->update([
            'description' => $this->audit->description,
        ]);

        $this->editing = false;
        $this->updated = true;
        $this->updateTaskState();
    }

    public function updateTaskState()
    {
        $task = $this->audit->task;
        // Update the task state
        UpdateTaskState::update($task, 2);
    }

    public function cancel()
    {
        $this->editing = false;
    }

    public function edit()
    {
        if ($this->editable) {
            $this->editing = true;
            $this->updated = false;
        } else {
            $this->err = 'You cannot edit this audit';
        }
    }

    // listeners
    protected $listeners = [
        'refreshAuditCompletion' => 'disable',
    ];


    public function disable()
    {
        $this->editable = false;
    }

    public function render()
    {
        return view('livewire.audit.audit-description');
    }
}

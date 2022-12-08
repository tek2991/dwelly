<?php

namespace App\Http\Livewire\Audit;

use App\Models\Audit;
use Livewire\Component;
use App\Models\AuditType;

class AuditCompletion extends Component
{
    public $audit;
    public $auditTypes;
    public $confirm = false;
    
    public $editable = false;
    public $onboarding_audit_type_id;
    public $deboarding_audit_type_id;
    public $move_in_audit_type_id;
    public $move_out_audit_type_id;
    public $operational_audit_type_id;

    public $err = null;

    public function mount(Audit $audit)
    {
        $this->audit = $audit;
        $this->auditTypes = AuditType::all();

        $audit_types = $this->auditTypes->pluck('id', 'name')->toArray();

        $this->onboarding_audit_type_id = $audit_types['Property Onboarding'];
        $this->deboarding_audit_type_id = $audit_types['Property De-boarding'];
        $this->move_in_audit_type_id = $audit_types['Move In'];
        $this->move_out_audit_type_id = $audit_types['Move Out'];
        $this->operational_audit_type_id = $audit_types['Operational'];

        $this->editable = $this->audit->completed === false && $this->audit->audit_type_id !== $this->operational_audit_type_id;
    }

    public function updated($propertyName)
    {
        if($propertyName === 'confirm' && $this->confirm === true) {
            $this->err = null;
        }
    }
    
    public function completeAudit(){
        if($this->editable === false) {
            $this->err = 'This audit is not editable.';
            return;
        }

        if($this->confirm !== true)
        {
            $this->err = 'Please confirm that you want to complete this audit.';
            return;
        }

        $this->audit->completed = true;
        $this->audit->updated_by = auth()->user()->id;
        $this->audit->save();

        $this->emit('refreshAuditCompletion');
        $this->editable = false;
    }

    public function render()
    {
        return view('livewire.audit.audit-completion');
    }
}

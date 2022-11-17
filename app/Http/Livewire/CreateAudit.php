<?php

namespace App\Http\Livewire;

use App\Models\Audit;
use App\Models\Tenant;
use Livewire\Component;
use App\Models\Property;
use App\Models\AuditType;

class CreateAudit extends Component
{
    public $auditTypes;
    public $properties;
    public $tenants;

    public $audit_date;
    public $property_id;
    public $audit_type_id;
    public $tenant_id;

    public $onboarding_audit_type_id;
    public $deboarding_audit_type_id;
    public $move_in_audit_type_id;
    public $move_out_audit_type_id;
    public $operational_audit_type_id;

    public function mount()
    {
        $this->properties = Property::all();
        $this->auditTypes = AuditType::all();

        $audit_types = $this->auditTypes->pluck('id', 'name')->toArray();

        $this->onboarding_audit_type_id = $audit_types['Property Onboarding'];
        $this->deboarding_audit_type_id = $audit_types['Property De-boarding'];
        $this->move_in_audit_type_id = $audit_types['Move In'];
        $this->move_out_audit_type_id = $audit_types['Move Out'];
        $this->operational_audit_type_id = $audit_types['Operational'];
    }

    public function rules()
    {
        return [
            'audit_date' => 'required|date',
            'property_id' => 'required|exists:properties,id',
            'audit_type_id' => 'required|exists:audit_types,id',
            'tenant_id' => 'exclude_if:audit_type_id,' . $this->onboarding_audit_type_id . '|required|exists:tenants,id',
        ];
    }

    public function updated($propertyName)
    {
        
        if ($propertyName == 'property_id') {
            $this->tenants = Tenant::where('property_id', $this->property_id)->with('user')->get();
            $this->tenant_id = null;
        }

        // If change in audit type
        if ($propertyName == 'audit_type_id') {
            // Check if the audit type is onboarding or deboarding
            if ($this->audit_type_id == $this->onboarding_audit_type_id || $this->audit_type_id == $this->deboarding_audit_type_id) {
                $this->tenant_id = null;
            }

            if ($this->audit_type_id == $this->move_in_audit_type_id || $this->audit_type_id == $this->move_out_audit_type_id) {
                $this->tenant_id = null;
            }
        }


        $this->validateOnly($propertyName);
    }


    public function render()
    {
        return view('livewire.create-audit');
    }
}

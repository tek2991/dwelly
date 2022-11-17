<?php

namespace App\Http\Livewire;

use App\Models\Audit;
use App\Models\Tenant;
use Livewire\Component;
use App\Models\Property;
use App\Models\AuditType;
use Illuminate\Validation\Rule;

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

    public $disable_submit = false;
    public $err = null;
    public $edit_btn = false;

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
            'tenant_id' => [
                Rule::excludeIf(function () {
                    return $this->audit_type_id == $this->onboarding_audit_type_id
                        || $this->audit_type_id == $this->deboarding_audit_type_id;
                }),
                'exists:tenants,id',
            ]
        ];
    }

    public function updated($propertyName)
    {
        
        if ($propertyName == 'property_id') {
            $this->tenants = Tenant::where('property_id', $this->property_id)->with('user')->get();
            $this->tenant_id = null;
        }

        $this->validateOnly($propertyName);

        // If change in audit type
        if ($propertyName == 'audit_type_id') {
            // Check if the audit type is onboarding or deboarding
            if ($this->audit_type_id == $this->onboarding_audit_type_id || $this->audit_type_id == $this->deboarding_audit_type_id) {
                $this->tenant_id = null;

                // Check if audit already exists for the property
                $audit = Audit::where('property_id', $this->property_id)
                    ->where('audit_type_id', $this->audit_type_id)
                    ->first();

                if ($audit) {
                    $this->disable_submit = true;
                    $this->edit_btn = true;
                    $this->err = $this->auditTypes->where('id', $this->audit_type_id)->first()->name . ' audit already exists for this property';
                } else {
                    $this->disable_submit = false;
                    $this->err = null;
                }
            }
        }

        // If cahnge in tenant id or audit type
        if ($propertyName == 'tenant_id' || $propertyName == 'audit_type_id') {
            // Check if the audit type is move in or move out
            if ($this->audit_type_id == $this->move_in_audit_type_id || $this->audit_type_id == $this->move_out_audit_type_id) {
                // If tenant id and audit type is not null
                if ($this->tenant_id && $this->audit_type_id) {
                    // Check if audit already exists for the tenant
                    $audit = Audit::where('tenant_id', $this->tenant_id)
                        ->where('audit_type_id', $this->audit_type_id)
                        ->where('property_id', $this->property_id)
                        ->first();

                    if ($audit) {
                        $this->disable_submit = true;
                        $this->edit_btn = true;
                        $this->err = $this->auditTypes->where('id', $this->audit_type_id)->first()->name . ' audit already exists for this tenant';
                    } else {
                        $this->disable_submit = false;
                        $this->err = null;
                    }
                }
            }
        }
    }

    public function store()
    {
        // Do not proceed if the submit button is disabled
        if ($this->disable_submit) {
            return;
        }

        $this->validate();

        $audit = Audit::create([
            'audit_date' => $this->audit_date,
            'property_id' => $this->property_id,
            'audit_type_id' => $this->audit_type_id,
            'tenant_id' => $this->tenant_id,
            'created_by' => auth()->user()->id,
            'completed' => false,
        ]);

        return redirect()->route('audits.show', $audit);
    }


    public function render()
    {
        return view('livewire.create-audit');
    }
}

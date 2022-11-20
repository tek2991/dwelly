<?php

namespace App\Http\Livewire;

use App\Models\Audit;
use App\Models\AuditChecklist;
use App\Models\Tenant;
use Livewire\Component;
use App\Models\Property;
use App\Models\AuditType;
use App\Models\Furniture;
use Illuminate\Validation\Rule;

class CreateAudit extends Component
{
    public $properties;
    public $auditTypes;
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

    public $disable_submit = true;
    public $err = null;
    public $edit_btn = false;

    public $existing_audit = null;

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
            'property_id' => 'required|exists:properties,id',
            'audit_type_id' => 'required|exists:audit_types,id',
            'audit_date' => 'required|date',
            'tenant_id' => [
                Rule::excludeIf(function () {
                    return $this->audit_type_id == $this->onboarding_audit_type_id
                        || $this->audit_type_id == $this->deboarding_audit_type_id;
                }),
                'exists:tenants,id',
            ]
        ];
    }

    public function disable($audit)
    {   
        $audit_type = $this->auditTypes->where('id', $this->audit_type_id)->first();
        $this->disable_submit = true;
        $this->err = "* {$audit_type->name} audit has already been created for this property/tenant.";
        $this->edit_btn = true;
        $this->existing_audit = $audit;
    }

    public function enable()
    {
        $this->disable_submit = false;
        $this->err = null;
        $this->edit_btn = false;
    }

    public function updated($propertyName)
    {
        // If change in property_id reset all other fields
        if ($propertyName == 'property_id') {
            $this->tenants = Tenant::where('property_id', $this->property_id)->with('user')->get();
            $this->tenant_id = null;
            $this->audit_date = null;
            $this->audit_type_id = null;
            $this->tenant_id = null;
            $this->disable_submit = false;
            $this->err = null;
        }

        // If audit_type_id is onboarding or deboarding check if audit already exists
        if ($this->audit_type_id == $this->onboarding_audit_type_id || $this->audit_type_id == $this->deboarding_audit_type_id) {
            $audit = Audit::where('property_id', $this->property_id)
                ->where('audit_type_id', $this->audit_type_id)
                ->first();

            $audit ? $this->disable($audit) : $this->enable();
        }

        // If audit_type_id is move in or move out check if audit already exists
        if ($this->audit_type_id == $this->move_in_audit_type_id || $this->audit_type_id == $this->move_out_audit_type_id) {
            $audit = Audit::where('property_id', $this->property_id)
                ->where('audit_type_id', $this->audit_type_id)
                ->where('tenant_id', $this->tenant_id)
                ->first();

            $audit ? $this->disable($audit) : $this->enable();
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

        if($audit->audit_type_id != $this->operational_audit_type_id) {
            $all_furnitures = Furniture::all();
            $property_furnitures = Property::find($this->property_id)->furnitures;

            foreach ($all_furnitures as $furniture) {
                $property_has_furniture = $property_furnitures->contains($furniture->id);
                $furniture_qty = $property_has_furniture ? $property_furnitures->where('id', $furniture->id)->first()->pivot->quantity : 0;
                
                // Create Audit Checklist
                AuditChecklist::create([
                    'audit_id' => $audit->id,
                    'checklistable_id' => $furniture->id,
                    'checklistable_type' => "App\Models\Furniture",
                    'total' => $furniture_qty,
                ]);
            }
        }

        return redirect()->route('audit.show', $audit);
    }


    public function render()
    {
        return view('livewire.create-audit');
    }
}

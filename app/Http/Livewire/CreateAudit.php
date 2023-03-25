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

    public $audit_type_id;
    public $audit_date;
    public $property_id;
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
        $this->auditTypes = AuditType::where('name', '!=', 'Property Onboarding')->get(); // Exclude Property Onboarding
        $this->properties = Property::all();

        $audit_types = $this->auditTypes->pluck('id', 'name')->toArray();

        $this->onboarding_audit_type_id = AuditType::where('name', 'Property Onboarding')->first()->id; // Get Property Onboarding type id
        $this->deboarding_audit_type_id = $audit_types['Property De-boarding'];
        $this->move_in_audit_type_id = $audit_types['Move In'];
        $this->move_out_audit_type_id = $audit_types['Move Out'];
        $this->operational_audit_type_id = $audit_types['Operational'];
    }

    public function rules()
    {
        return [
            'audit_type_id' => 'required|exists:audit_types,id',
            'audit_date' => 'required|date',
            'property_id' => [
                'nullable',
                Rule::requiredIf(function () {
                    return $this->audit_type_id == $this->move_in_audit_type_id
                        || $this->audit_type_id == $this->move_out_audit_type_id
                        || $this->audit_type_id == $this->deboarding_audit_type_id;
                }),
                'exists:properties,id',
            ],
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
        // If change in audit_type_id reset all other fields
        if ($propertyName == 'audit_type_id') {
            $this->audit_date = null;
            $this->property_id = null;
            $this->tenant_id = null;
            $this->disable_submit = false;
            $this->err = null;
        }

        // If change in property_id reset tenant_id and tenants
        if ($propertyName == 'property_id') {
            $this->tenant_id = null;
            $this->tenants = Tenant::where('property_id', $this->property_id)->get();
            $this->disable_submit = false;
            $this->err = null;
        }

        // If audit_type_id is onboarding or deboarding check if audit already exists
        if (($this->audit_type_id == $this->onboarding_audit_type_id || $this->audit_type_id == $this->deboarding_audit_type_id) && $this->property_id) {
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

        $this->property_id = $this->property_id == "" ? null : $this->property_id;
        $this->tenant_id = $this->tenant_id == "" ? null : $this->tenant_id;

        $this->validate();

        $audit = Audit::create([
            'audit_type_id' => $this->audit_type_id,
            'audit_date' => $this->audit_date,
            'property_id' => $this->property_id,
            'tenant_id' => $this->tenant_id,
            'created_by' => auth()->user()->id,
            'completed' => false,
            'description' => $this->auditTypes->where('id', $this->audit_type_id)->first()->name . ' Audit. Created on ' . now()->format('d/m/Y'),
        ]);

        if($this->property_id){
            $property = Property::find($this->property_id);

            $property_rooms = $property->rooms;
            $property_furnitures = $property->furnitures()->where('is_primary', true)->get();

            // Create checklist items for rooms
            foreach ($property_rooms as $room) {
                $no_of_rooms = $room->pivot->quantity;

                for ($i = 0; $i < $no_of_rooms; $i++) {
                    AuditChecklist::create([
                        'audit_id' => $audit->id,
                        'checklistable_id' => $room->id,
                        'checklistable_type' => 'App\Models\Room',
                        'is_primary' => true,
                        'primary_audit_checklist_id' => null,
                        'name' => $room->name . ' ' . ($i + 1),
                        'remarks' => 'N/A',
                    ]);
                }
            }

            // Create checklist items for furnitures
            foreach ($property_furnitures as $furniture) {
                $no_of_furnitures = $furniture->pivot->quantity;

                for ($i = 0; $i < $no_of_furnitures; $i++) {
                    AuditChecklist::create([
                        'audit_id' => $audit->id,
                        'checklistable_id' => $furniture->id,
                        'checklistable_type' => 'App\Models\Furniture',
                        'is_primary' => true,
                        'primary_audit_checklist_id' => null,
                        'name' => $furniture->name . ' ' . ($i + 1),
                        'remarks' => 'N/A',
                    ]);
                }
            }
        }

        return redirect()->route('audit.show', $audit);
    }


    public function render()
    {
        return view('livewire.create-audit');
    }
}

<?php

namespace App\Http\Livewire\Onboarding;

use App\Models\Task;
use App\Models\Audit;
use App\Models\Property;
use App\Models\AuditType;
use App\Models\Onboarding;
use App\Models\AuditChecklist;
use LivewireUI\Modal\ModalComponent;

class AuditConfirmModal extends ModalComponent
{
    public $property_id;
    public $onboarding;

    public $hasAudit;
    public $canStartAudit;
    public $auditCompleted;

    public function mount($property_id)
    {
        $this->property_id = $property_id;
        $this->onboarding = Onboarding::where('property_id', $property_id)->first();

        $this->hasAudit = $this->onboarding->audit()->exists();
        $this->canStartAudit = $this->onboarding->canStartAudit();
        $this->auditCompleted = $this->onboarding->auditCompleted();
    }

    public function startAudit()
    {
        $audit = Audit::create([
            'audit_type_id' => AuditType::where('name', 'Property Onboarding')->first()->id,
            'audit_date' => now(),
            'property_id' => $this->property_id,
            'tenant_id' => null,
            'created_by' => auth()->user()->id,
            'completed' => false,
            'description' => 'Property Onboarding Audit. Created on ' . now()->format('d/m/Y'),
        ]);

        // Create task
        Task::create([
            'description' => "Property Onboarding Audit for " . Property::find($this->property_id)->name . ". Created on " . now()->format('d/m/Y'),
            'task_state_id' => 1,
            'priority_id' => $this->onboarding->task->priority_id,
            'assigned_to' => $this->onboarding->task->assigned_to,
            'created_by' => auth()->user()->id,
            'taskable_id' => $audit->id,
            'taskable_type' => 'App\Models\Audit',
        ]);

        $this->onboarding->audit_id = $audit->id;
        $this->onboarding->save();

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


        return redirect()->route('audit.edit', $audit);
    }

    public function render()
    {
        return view('livewire.onboarding.audit-confirm-modal');
    }
}

<?php

namespace App\Http\Livewire\Audit;

use Livewire\Component;

class ChecklistChecklist extends Component
{
    public $primary_audit_checklist_id;
    public $auditChecklist;
    public $audit;

    public $editable = false;


    public function mount($primary_audit_checklist_id)
    {
        $this->primary_audit_checklist_id = $primary_audit_checklist_id;
        $this->auditChecklist = \App\Models\AuditChecklist::find($this->primary_audit_checklist_id);
        $this->audit = $this->auditChecklist->audit;

        $this->editable = $this->audit->completed == false && $this->auditChecklist->completed == false;
    }

    // listeners
    protected $listeners = [
        'refreshAuditCompletion' => 'disable',
        'refreshAuditChecklistCompletion' => 'disable',
    ];


    public function disable()
    {
        $this->editable = false;
    }

    public function render()
    {
        return view('livewire.audit.checklist-checklist');
    }
}

<?php

namespace App\Http\Livewire\Audit;

use App\Models\Audit;
use App\Models\AuditChecklist;
use Livewire\Component;
use App\Models\AuditType;

class AuditCheckLists extends Component
{
    public $audit = null;
    public $auditTypes;
    public $audit_checklists = null;
    public $checklist = [];

    public $editable = false;
    public $editing = false;
    public $updated = false;
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
        $this->audit_checklists = $audit->auditChecklists;

        foreach ($this->audit_checklists as $auditChecklist) {
            $item = [
                'id' => $auditChecklist->id,
                'good' => $auditChecklist->good,
                'bad' => $auditChecklist->bad,
            ];

            $this->checklist[$auditChecklist->id] = $item;
        }

        $audit_types = $this->auditTypes->pluck('id', 'name')->toArray();

        $this->onboarding_audit_type_id = $audit_types['Property Onboarding'];
        $this->deboarding_audit_type_id = $audit_types['Property De-boarding'];
        $this->move_in_audit_type_id = $audit_types['Move In'];
        $this->move_out_audit_type_id = $audit_types['Move Out'];
        $this->operational_audit_type_id = $audit_types['Operational'];
        $this->editable = $this->audit->completed === false && $this->audit->audit_type_id !== $this->operational_audit_type_id;
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

    public function update()
    {
        if ($this->editable === false) {
            $this->err = 'This audit is not editable.';
            return;
        }

        $this->validate([
            'checklist.*.id' => 'required|exists:audit_checklists,id',
            'checklist.*.good' => 'required',
            'checklist.*.bad' => 'required',
        ]);

        foreach ($this->checklist as $checklist) {
            AuditChecklist::find($checklist['id'])->update([
                'good' => $checklist['good'],
                'bad' => $checklist['bad'],
            ]);
        }

        $this->editing = false;
        $this->updated = true;
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
        return view('livewire.audit.audit-check-lists');
    }
}

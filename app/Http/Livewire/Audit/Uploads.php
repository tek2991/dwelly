<?php

namespace App\Http\Livewire\Audit;

use Livewire\Component;
use App\Models\AuditChecklist;

class Uploads extends Component
{
    public $editable;
    public $checklist_id;
    public $auditChecklist;
    public $uploads;

    public function mount($checklist_id)
    {
        $this->checklist_id = $checklist_id;
        $this->auditChecklist = AuditChecklist::find($checklist_id);
        $this->uploads = $this->auditChecklist->uploads;

        $this->editable = $this->auditChecklist->audit->completed == false && $this->auditChecklist->completed == false;
    }

    // listeners
    protected $listeners = [
        'refreshAuditUploads' => 'refresh',
        'refreshAuditChecklistCompletion' => 'disable',
    ];

    public function refresh()
    {
        $this->uploads = $this->auditChecklist->uploads;
    }

    public function disable()
    {
        $this->editable = false;
    }

    public function render()
    {
        return view('livewire.audit.uploads');
    }
}

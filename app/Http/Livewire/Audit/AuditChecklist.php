<?php

namespace App\Http\Livewire\Audit;

use Livewire\Component;

class AuditChecklist extends Component
{
    public $audit;
    public $editable = false;


    public function mount($audit = null)
    {
        $this->audit = $audit;
        $this->editable = $this->audit->completed == false && $this->audit->task->task_state_id < 3 ? true : false;
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
        return view('livewire.audit.audit-checklist');
    }
}

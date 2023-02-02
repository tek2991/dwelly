<?php

namespace App\Http\Livewire\Audit;

use Livewire\Component;

class CompleteAudit extends Component
{
    public $editable = false;
    public $audit;
    public $confirm;
    public $err;

    public function mount($audit)
    {
        $this->audit = $audit;
        $this->confirm = $audit->completed;
        $this->editable = $this->audit->completed == false;
    }

    public function rules()
    {
        return [
            'confirm' => 'required|accepted',
        ];
    }

    public function complete()
    {
        $this->validate();

        $auditChecklists_completed = $this->audit->auditChecklists->pluck('completed')->all();

        if (in_array(false, $auditChecklists_completed)) {
            $this->err = 'Please complete all checklist items before completing the audit.';
            return;
        }

        $this->audit->update([
            'completed' => true,
        ]);

        // emit
        $this->emit('refreshAuditCompletion');

        $this->editable = false;
    }

    public function render()
    {
        return view('livewire.audit.complete-audit');
    }
}

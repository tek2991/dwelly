<?php

namespace App\Http\Livewire\Audit;

use Livewire\Component;
use App\Actions\Helpers\UpdateTaskState;

class VerifyChecklist extends Component
{
    public $editable;
    public $auditChecklist;
    public $confirm;
    public $err;

    public function mount($auditChecklist)
    {
        $this->auditChecklist = $auditChecklist;
        $this->confirm = $auditChecklist->completed;
        $this->editable = $this->auditChecklist->audit->task->completed() == false && $this->auditChecklist->completed == true && $this->auditChecklist->verified == false;
    }

    public function rules()
    {
        return [
            'confirm' => 'required|accepted',
        ];
    }

    public function verify()
    {
        $this->validate();

        $this->auditChecklist->update([
            'verified' => true,
        ]);

        // emit
        $this->emit('refreshAuditChecklistCompletion');
        $this->editable = false;

        // redirect to audit show
        return redirect()->route('audit.edit', $this->auditChecklist->audit->id);
    }

    public function render()
    {
        return view('livewire.audit.verify-checklist');
    }
}

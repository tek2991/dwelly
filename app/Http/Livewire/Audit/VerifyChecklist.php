<?php

namespace App\Http\Livewire\Audit;

use Livewire\Component;
use App\Actions\Helpers\UpdateTaskState;

class VerifyChecklist extends Component
{
    public $editable;
    public $auditChecklist;
    public $confirm = false;
    public $err;
    public $next_checklist_item_exists = false;

    public function mount($auditChecklist)
    {
        $this->auditChecklist = $auditChecklist;
        $this->editable = $this->auditChecklist->audit->task->completed() == false && $this->auditChecklist->completed == true && $this->auditChecklist->verified == false;

        $this->next_checklist_item_exists = $this->auditChecklist->audit->auditChecklists->where('completed', true)->where('verified', false)->whereNotIn('id', [$this->auditChecklist->id])->first();
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

        $this->routeTo();
    }

    public function routeTo()
    {

        if($this->next_checklist_item_exists) {
            return redirect()->route('auditChecklist.show', $this->next_checklist_item_exists->id);
        }

        return redirect()->route('audit.edit', $this->auditChecklist->audit->id);
    }

    public function render()
    {
        return view('livewire.audit.verify-checklist');
    }
}

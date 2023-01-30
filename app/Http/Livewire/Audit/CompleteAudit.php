<?php

namespace App\Http\Livewire\Audit;

use Livewire\Component;

class CompleteAudit extends Component
{
    public $audit;

    public $confirm;

    public $err;

    public function mount($audit)
    {
        $this->audit = $audit;
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

        $this->audit->update([
            'completed' => true,
        ]);

        // emit
        $this->emit('refreshAuditCompletion');
    }

    public function render()
    {
        return view('livewire.audit.complete-audit');
    }
}

<?php

namespace App\Http\Livewire\Audit;

use Livewire\Component;

class AssignAudit extends Component
{
    public $audit;
    public $properties;
    public $editable;

    public $property_id;

    public $err;

    public function mount($audit)
    {
        $this->audit = $audit;
        $this->properties = \App\Models\Property::all();
        $this->editable = $this->audit->completed;

        $this->property_id = $this->audit->property_id ?? null;
    }


    public function render()
    {
        return view('livewire.audit.assign-audit');
    }
}

<?php

namespace App\Http\Livewire\Audit;

use Livewire\Component;

class AssignAudit extends Component
{
    public $audit;
    public $properties;

    public $editable = false;
    public $editing = false;
    public $updated = false;

    public $assign_or_create = 1;
    public $property_id;

    public $err;

    public function mount($audit)
    {
        $this->audit = $audit;
        $this->properties = \App\Models\Property::all();

        $this->property_id = $this->audit->property_id ?? null;
        $this->assign_or_create = $this->property_id ? 2 : 1;

        $this->editable = $this->audit->completed === false;
    }

    public function rules()
    {
        return [
            'assign_or_create' => 'required|in:1,2',
            'property_id' => 'nullable|required_if:assign_or_create,2|exists:properties,id',
        ];
    }

    public function assign()
    {
        $this->validate();

        if ($this->assign_or_create === 1) {
            $this->audit->update([
                'property_id' => null,
            ]);

            // Redirect to create property
            return redirect()->route('property.create', ['audit_id' => $this->audit->id]);
        } else {
            $this->audit->update([
                'property_id' => $this->property_id,
            ]);
            $this->updated = true;
            $this->editing = false;
        }
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
        return view('livewire.audit.assign-audit');
    }
}

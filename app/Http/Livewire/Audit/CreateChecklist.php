<?php

namespace App\Http\Livewire\Audit;

use App\Models\Room;
use App\Models\Audit;
use Livewire\Component;
use App\Models\Furniture;
use App\Models\AuditChecklist;
use Illuminate\Validation\Rule;

class CreateChecklist extends Component
{
    // Item types object
    public $item_types = [
        1 => 'Furnitures',
        2 => 'Rooms',
    ];

    // Item types model name
    public $item_types_model = [
        1 => 'App\Models\Furniture',
        2 => 'App\Models\Room'
    ];

    public $audit_id;
    public $primary_audit_checklist_id;
    public $rooms;
    public $primary_furnitures;

    // public $disable_submit = false;
    // public $err = null;
    // public $edit_btn = false;

    public $item_type_id;
    public $room_id;
    public $primary_furniture_id;
    public $remarks;

    public $secondary_furnitures;
    public $secondary_furniture_id;

    public function mount($audit_id, $primary_audit_checklist_id)
    {
        $this->audit_id = $audit_id;
        $this->primary_audit_checklist_id = $primary_audit_checklist_id;
        $this->rooms = Room::all();
        $this->primary_furnitures = Furniture::where('is_primary', true)->withCount('secondaryFurnitures')->get();

        if ($primary_audit_checklist_id) {
            $primary_audit_checklist = AuditChecklist::find($primary_audit_checklist_id);

            $this->item_type_id = $primary_audit_checklist->checklistable_type == 'App\Models\Furniture' ? 1 : 2;
            $this->room_id = $primary_audit_checklist->checklistable_type == 'App\Models\Room' ? $primary_audit_checklist->checklistable_id : null;
            $this->primary_furniture_id = $primary_audit_checklist->checklistable_type == 'App\Models\Furniture' ? $primary_audit_checklist->checklistable_id : null;

            if ($this->item_type_id == 1) {
                $this->secondary_furnitures = Furniture::where('is_primary', false)->where('primary_furniture_id', $this->primary_furniture_id)->get();
            }
        }
    }

    public function rules()
    {
        return [
            'item_type_id' => 'required|in:1,2',
            'primary_furniture_id' => 'nullable|required_if:item_type_id,1|exists:furniture,id',
            'secondary_furniture_id' => [
                'nullable',
                Rule::requiredIf(function () {
                    return $this->item_type_id == 1 && $this->primary_furniture_id && $this->primary_audit_checklist_id;
                }),
                Rule::exists('furniture', 'id')->where(function ($query) {
                    $query->where('primary_furniture_id', $this->primary_furniture_id);
                })
            ],
            'room_id' => 'nullable|required_if:item_type_id,2|exists:rooms,id',
            'remarks' => 'nullable|string|max:255',
        ];
    }

    public function updated($propertyName)
    {
        if ($propertyName == 'item_type_id') {
            $this->room_id = null;
            $this->primary_furniture_id = null;
        }

        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();

        if (
            Audit::find($this->audit_id)->completed
        ) {
            // Stop
            return;
        }

        AuditChecklist::create([
            'audit_id' => $this->audit_id,
            'checklistable_id' => $this->item_type_id == 1 ? $this->secondary_furniture_id : $this->room_id,
            'checklistable_type' => $this->item_types_model[$this->item_type_id],
            'is_primary' => false,
            'primary_audit_checklist_id' => $this->primary_audit_checklist_id,
            'remarks' => $this->remarks,
        ]);

        // redirect to audit page
        return redirect()->route('audit.show', $this->audit_id);
    }

    public function render()
    {
        return view('livewire.audit.create-checklist');
    }
}

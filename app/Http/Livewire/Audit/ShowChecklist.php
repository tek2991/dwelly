<?php

namespace App\Http\Livewire\Audit;

use App\Models\AuditChecklist;
use App\Models\Room;
use Livewire\Component;
use App\Models\Furniture;
use Illuminate\Validation\Rule;

class ShowChecklist extends Component
{
    public $editing = false;
    public $saved = false;

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

    public $checklist_id;
    public $checklist;
    public $rooms;
    public $primary_furnitures;

    // public $disable_submit = false;
    // public $err = null;
    // public $edit_btn = false;

    public $item_type_id;
    public $room_id;
    public $primary_furniture_id;
    public $remarks;

    public $secondary_furniture_id;
    public $secondary_furnitures;

    public $hasSecondary;

    public function mount($checklist_id)
    {
        $this->checklist_id = $checklist_id;
        $this->checklist = AuditChecklist::find($checklist_id);
        $this->rooms = Room::all();
        $this->primary_furnitures = Furniture::where('is_primary', true)->withCount('secondaryFurnitures')->get();

        $this->item_type_id = $this->checklist->checklistable_type == 'App\Models\Furniture' ? 1 : 2;

        if ($this->item_type_id == 1) {
            if ($this->checklist->is_primary) {
                $this->primary_furniture_id = $this->checklist->checklistable_id;
            } else {
                $this->primary_furniture_id = $this->checklist->checklistable->primaryFurniture->id;
                $this->secondary_furniture_id = $this->checklist->checklistable_id;
                $this->secondary_furnitures = Furniture::where('primary_furniture_id', $this->primary_furniture_id)->get();
            }
        }else{
            $this->room_id = $this->checklist->checklistable_id;
        }
        $this->remarks = $this->checklist->remarks;

        $this->hasSecondary = $this->checklist->is_primary ? $this->checklist->secondaryAuditChecklists->count() > 0 : false;
    }

    public function rules()
    {
        return [
            'item_type_id' => 'required|in:1,2',
            'primary_furniture_id' => 'nullable|required_if:item_type_id,1|exists:furniture,id',
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

    public function edit()
    {
        $this->editing = true;
        $this->saved = false;
    }

    public function cancel()
    {
        $this->editing = false;
    }

    public function update()
    {
        $this->validate();

        $this->checklist->update([
            'checklistable_type' => $this->item_types_model[$this->item_type_id],
            'checklistable_id' => $this->item_type_id == 1 ? $this->primary_furniture_id : $this->room_id,
            'remarks' => $this->remarks,
        ]);

        $this->editing = false;
        $this->saved = true;
    }

    public function render()
    {
        return view('livewire.audit.show-checklist');
    }
}

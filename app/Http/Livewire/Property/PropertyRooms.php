<?php

namespace App\Http\Livewire\Property;

use App\Models\Room;
use Livewire\Component;
use App\Models\Property;

class PropertyRooms extends Component
{
    public $editing = false;
    public $updated = false;
    public $allRooms;

    public $rooms = [];

    public Property $property;

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->allRooms = Room::all();

        // Loop through all the Rooms and check if the property has them
        foreach ($this->allRooms as $room) {
            // Create an item object
            $item = [
                'id' => $room->id,
                'name' => $room->name,
                'quantity' => $this->property->Rooms->contains($room->id) ? $property->rooms->find($room->id)->pivot->quantity : 0,
            ];

            $this->rooms[] = $item;
        }
    }

    public function edit()
    {
        $this->editing = true;
        $this->updated = false;
    }
        
    public function cancel()
    {
        $this->editing = false;
    }

    public function update()
    {
        // Remove all the Rooms from the property
        $this->property->Rooms()->detach();

        // Loop through the Rooms and add them with the quantity
        foreach ($this->rooms as $room) {
            if ($room['quantity']) {
                $this->property->Rooms()->attach($room['id'], ['quantity' => $room['quantity']]);
            }
        }

        $this->editing = false;
        $this->updated = true;
    }
    
    public function render()
    {
        return view('livewire.property.property-rooms');
    }
}

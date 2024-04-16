<?php

namespace App\Http\Livewire\Property;

use App\Models\Room;
use Livewire\Component;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::user()->cannot('update', $this->property)) {
            abort(403, 'You are not authorized to edit property.');
        }
        $this->editing = true;
        $this->updated = false;
    }
        
    public function cancel()
    {
        $this->editing = false;
    }

    public function update()
    {
        if (Auth::user()->cannot('update', $this->property)) {
            abort(403, 'You are not authorized to edit property.');
        }
        // Remove all the Rooms from the property
        $this->property->rooms()->detach();

        // Loop through the Rooms and add them with the quantity
        foreach ($this->rooms as $room) {
            if ($room['quantity']) {
                $this->property->rooms()->attach($room['id'], ['quantity' => $room['quantity']]);
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

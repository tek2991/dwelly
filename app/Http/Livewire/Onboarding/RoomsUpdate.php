<?php

namespace App\Http\Livewire\Onboarding;

use App\Models\Room;
use Livewire\Component;
use App\Models\Furniture;

class RoomsUpdate extends Component
{
    public $allRooms;

    public $rooms = [];

    public $property;
    public $onboarding_id;

    public function mount($property)
    {
        $this->property = $property;
        $this->onboarding_id = $property->onboarding->id;
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


    public function update()
    {
        // Remove all the Rooms from the property
        $this->property->rooms()->detach();

        // Loop through the Rooms and add them with the quantity
        foreach ($this->rooms as $room) {
            if ($room['quantity']) {
                $this->property->rooms()->attach($room['id'], ['quantity' => $room['quantity']]);
            }
        }
    }

    public function save()
    {
        $this->update();

        $this->property->onboarding->update([
            'rooms_data' => true,
        ]);

        return redirect()->route('onboarding.show', $this->onboarding_id);
    }

    public function render()
    {
        return view('livewire.onboarding.rooms-update');
    }
}

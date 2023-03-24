<?php

namespace App\Http\Livewire\Onboarding;

use Livewire\Component;
use App\Models\Furniture;

class RoomsUpdate extends Component
{
    public $allFurnitures;

    public $furnitures = [];

    public $property;
    public $onboarding_id;

    public function mount($property)
    {
        $this->property = $property;
        $this->onboarding_id = $property->onboarding->id;
        $this->allFurnitures = Furniture::all();

        // Loop through all the Furnitures and check if the property has them
        foreach ($this->allFurnitures as $furniture) {
            // Create an item object
            $item = [
                'id' => $furniture->id,
                'name' => $furniture->name,
                'quantity' => $this->property->Furnitures->contains($furniture->id) ? $property->furnitures->find($furniture->id)->pivot->quantity : 0,
            ];

            // Add the item to the furnitures array with the furniture id as the key
            $this->furnitures[$furniture->id] = $item;
        }
    }
    

    public function update()
    {
        // Remove all the Furnitures from the property
        $this->property->Furnitures()->detach();

        // Loop through the Furnitures and add them with the quantity
        foreach ($this->furnitures as $furniture) {
            if ($furniture['quantity']) {
                $this->property->Furnitures()->attach($furniture['id'], ['quantity' => $furniture['quantity']]);
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

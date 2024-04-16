<?php

namespace App\Http\Livewire\Property;

use Livewire\Component;
use App\Models\Property;
use App\Models\Furniture;
use Illuminate\Support\Facades\Auth;

class PropertyFurnitures extends Component
{
    public $editing = false;
    public $updated = false;
    public $allFurnitures;

    public $furnitures = [];

    public Property $property;

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->allFurnitures = Furniture::where('is_primary', true)->get();

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
        // Remove all the Furnitures from the property
        $this->property->Furnitures()->detach();

        // Loop through the Furnitures and add them with the quantity
        foreach ($this->furnitures as $furniture) {
            if ($furniture['quantity']) {
                $this->property->Furnitures()->attach($furniture['id'], ['quantity' => $furniture['quantity']]);
            }
        }

        $this->editing = false;
        $this->updated = true;
    }

    public function render()
    {
        return view('livewire.property.property-furnitures');
    }
}

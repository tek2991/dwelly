<?php

namespace App\Http\Livewire\Property;

use App\Models\Amenity;
use Livewire\Component;
use App\Models\Property;

class PropertyAmenities extends Component
{
    public $editing = false;
    public $updated = false;
    public $allAmenities;

    public $amenities = [];

    public Property $property;

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->allAmenities = Amenity::all();

        // Loop through all the amenities and check if the property has them
        foreach ($this->allAmenities as $amenity) {
            // Create an item object
            $item = [
                'id' => $amenity->id,
                'name' => $amenity->name,
                'has' => $this->property->amenities->contains($amenity->id) ? '1' : '0',
            ];

            $this->amenities[] = $item;
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
        // Remove all the amenities from the property
        $this->property->amenities()->detach();

        // Loop through the amenities and add the ones that are checked
        foreach ($this->amenities as $amenity) {
            if ($amenity['has']) {
                $this->property->amenities()->attach($amenity['id']);
            }
        }

        $this->editing = false;
        $this->updated = true;
    }

    public function render()
    {
        return view('livewire.property.property-amenities');
    }
}

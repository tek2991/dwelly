<?php

namespace App\Http\Livewire\Onboarding;

use App\Models\Amenity;
use Livewire\Component;

class AmenitiesUpdate extends Component
{
    public $allAmenities;
    public $amenities = [];
    public $property;
    public $onboarding_id;

    public function mount($property)
    {
        $this->property = $property;
        $this->onboarding_id = $property->onboarding->id;
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
    }

    public function save()
    {
        $this->update();

        $this->property->onboarding->update([
            'amenities_data' => true,
        ]);

        return redirect()->route('onboarding.show', $this->onboarding_id);
    }

    public function render()
    {
        return view('livewire.onboarding.amenities-update');
    }
}

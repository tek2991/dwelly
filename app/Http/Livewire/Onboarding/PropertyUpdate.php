<?php

namespace App\Http\Livewire\Onboarding;

use App\Models\Bhk;
use App\Models\Audit;
use Livewire\Component;
use App\Models\Flooring;
use App\Models\Locality;
use App\Models\Property;
use App\Models\Furnishing;
use App\Models\Onboarding;
use App\Models\PropertyType;

class PropertyUpdate extends Component
{
    public $err;
    // public $audit_id;
    public $onboarding_id;
    public $property_id;
    public $disabled;

    public $propertyTypes;
    public $bhks;
    public $floorings;
    public $furnishings;
    public $localities;

    public $code;
    public $is_available;
    public $bhk_id;
    public $property_type_id;
    public $floor_space;
    public $flooring_id;
    public $furnishing_id;
    public $floors;
    public $total_floors;
    public $address;
    public $building_name;
    public $landmark;
    public $locality_id;
    public $latitude;
    public $longitude;
    public $google_maps_link = 'https://www.google.com/maps/search/?api=1&query=';
    public $rent;
    public $security_deposit;
    public $society_fee;
    public $booking_amount;
    public $is_promoted;
    public $available_from;

    public function mount($property)
    {
        // $this->audit_id = $audit_id;
        $this->propertyTypes = PropertyType::all();
        $this->bhks = Bhk::all();
        $this->floorings = Flooring::all();
        $this->furnishings = Furnishing::all();
        $this->localities = Locality::all();

        // Set default values
        $this->available_from = now()->format('Y-m-d');
        $this->property_id = $property->id;
        $this->code = $property->code;
        $this->is_available = $property->is_available;
        $this->bhk_id = $property->bhk_id;
        $this->property_type_id = $property->property_type_id;
        $this->floor_space = $property->floor_space;
        $this->flooring_id = $property->flooring_id;
        $this->furnishing_id = $property->furnishing_id;
        $this->floors = $property->floors;
        $this->total_floors = $property->total_floors;
        $this->address = $property->address;
        $this->building_name = $property->building_name;
        $this->landmark = $property->landmark;
        $this->locality_id = $property->locality_id;
        $this->latitude = $property->latitude;
        $this->longitude = $property->longitude;
        $this->google_maps_link = 'https://www.google.com/maps/search/?api=1&query=' . $property->latitude . ',' . $property->longitude;
        $this->rent = $property->rent;
        $this->security_deposit = $property->security_deposit;
        $this->society_fee = $property->society_fee;
        $this->booking_amount = $property->booking_amount;
        $this->is_promoted = $property->is_promoted;
        $this->available_from = $property->available_from->format('Y-m-d');

        // Load onboarding
        $this->onboarding_id = $property->onboarding->id;
        $this->disabled = $property->onboarding->audit()->exists();
    }

    protected function rules()
    {
        return [
            'code' => 'required|string|max:255|unique:properties,code,' . $this->property_id,
            'is_available' => 'required|boolean',
            'bhk_id' => 'required|integer',
            'property_type_id' => 'required|integer',
            'floor_space' => 'required|integer',
            'flooring_id' => 'required|integer',
            'furnishing_id' => 'required|integer',
            'floors' => 'required|integer',
            'total_floors' => 'required|integer',
            'address' => 'required|string|max:255',
            'building_name' => 'nullable|string|max:255',
            'landmark' => 'nullable|string|max:255',
            'locality_id' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'rent' => 'required|integer',
            'security_deposit' => 'required|integer',
            'society_fee' => 'required|integer',
            'booking_amount' => 'required|integer',
            'is_promoted' => 'required|boolean',
            'available_from' => 'required|date',
        ];
    }

    // Create google maps link when latitude and longitude are updated
    public function updated($propertyName)
    {
        if ($propertyName == 'latitude' || $propertyName == 'longitude') {
            $this->google_maps_link = 'https://www.google.com/maps/search/?api=1&query=' . $this->latitude . ',' . $this->longitude;
        }

        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $property = Property::find($this->property_id);
        $property->update([
            'code' => $this->code,
            'is_available' => $this->is_available,
            'bhk_id' => $this->bhk_id,
            'property_type_id' => $this->property_type_id,
            'floor_space' => $this->floor_space,
            'flooring_id' => $this->flooring_id,
            'furnishing_id' => $this->furnishing_id,
            'floors' => $this->floors,
            'total_floors' => $this->total_floors,
            'address' => $this->address,
            'building_name' => $this->building_name,
            'landmark' => $this->landmark,
            'locality_id' => $this->locality_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'rent' => $this->rent,
            'security_deposit' => $this->security_deposit,
            'society_fee' => $this->society_fee,
            'booking_amount' => $this->booking_amount,
            'is_promoted' => $this->is_promoted,
            'available_from' => $this->available_from,
        ]);
    }


    public function save()
    {
        $this->validate();
        $this->update();

        // Redirect to onboarding
        return redirect()->route('onboarding.edit', $this->onboarding_id);
    }

    public function render()
    {
        return view('livewire.onboarding.property-update');
    }
}

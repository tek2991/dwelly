<?php

namespace App\Http\Livewire\Property;

use App\Models\Bhk;
use App\Models\Flooring;
use App\Models\Furnishing;
use App\Models\Locality;
use App\Models\Property;
use App\Models\PropertyType;
use Livewire\Component;

class PropertyDetails extends Component
{
    public $editing = false;
    public $updated = false;

    public Property $property;
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
    public $google_maps_link;
    public $rent;
    public $security_deposit;
    public $society_fee;
    public $booking_amount;
    public $is_promoted;
    public $available_from;

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->propertyTypes = PropertyType::all();
        $this->bhks = Bhk::all();
        $this->floorings = Flooring::all();
        $this->furnishings = Furnishing::all();
        $this->localities = Locality::all();

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
        // Generate google maps link
        $this->google_maps_link = 'https://www.google.com/maps/search/?api=1&query=' . $property->latitude . ',' . $property->longitude;
        $this->rent = $property->rent;
        $this->security_deposit = $property->security_deposit;
        $this->society_fee = $property->society_fee;
        $this->booking_amount = $property->booking_amount;
        $this->is_promoted = $property->is_promoted;
        $this->available_from = $property->available_from->format('Y-m-d');
    }

    protected function rules(){
        return [
            // Code is unique except for the current property
            'code' => 'required|string|max:255|unique:properties,code, ' . $this->property->id,
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

    public function edit()
    {
        $this->editing = true;
        $this->updated = false;
    }

    public function update()
    {
        $this->validate();

        $this->property->update([
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
            'securityDeposit' => $this->security_deposit,
            'societyFee' => $this->society_fee,
            'bookingAmount' => $this->booking_amount,
            'is_promoted' => $this->is_promoted,
            'available_from' => $this->available_from,
        ]);

        $this->editing = false;
        $this->updated = true;
    }
    
    public function cancel()
    {
        $this->editing = false;
    }


    public function render()
    {
        return view('livewire.property.property-details');
    }
}

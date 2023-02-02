<?php

namespace App\Http\Livewire\Property;

use App\Models\Bhk;
use App\Models\Audit;
use Livewire\Component;
use App\Models\Flooring;
use App\Models\Locality;
use App\Models\Property;
use App\Models\Furnishing;
use App\Models\PropertyType;

class CreateProperty extends Component
{
    public $audit_id;

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

    public function mount($audit_id)
    {
        $this->audit_id = $audit_id;
        $this->propertyTypes = PropertyType::all();
        $this->bhks = Bhk::all();
        $this->floorings = Flooring::all();
        $this->furnishings = Furnishing::all();
        $this->localities = Locality::all();

        // Set default values
        $this->available_from = now()->format('Y-m-d');
    }

    protected function rules()
    {
        return [
            'code' => 'required|string|max:255|unique:properties,code',
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

            'audit_id' => 'nullable|integer|exists:audits,id'
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


    public function store()
    {
        $this->validate();

        $user = auth()->user();

        $property = Property::create([
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
            'created_by' => $user->id,
        ]);

        // Attach audit to property
        if ($this->audit_id) {
            $audit = Audit::find($this->audit_id);
            $audit->update([
                'property_id' => $property->id
            ]);

            $checklists = $audit->checklists()->where('is_primary', true)->get();

            $model_relation_names = [
               'App\Models\Furniture' => 'furniture',
                'App\Models\Room' => 'rooms',
            ];

            foreach ($checklists as $checklist) {
                $relation = $model_relation_names[$checklist->checklistable_type];
                $quantity = 1;

                // Check if the property has the checklistable
                if ($property->$relation()->where('id', $checklist->checklistable_id)->exists()) {
                    $quantity = $property->$relation()->where('id', $checklist->checklistable_id)->first()->pivot->quantity + 1;

                    // Update the quantity
                    $property->$relation()->updateExistingPivot($checklist->checklistable_id, [
                        'quantity' => $quantity
                    ]);
                }else{
                    // Attach the checklistable to the property
                    $property->$relation()->attach($checklist->checklistable_id, [
                        'quantity' => $quantity
                    ]);
                }
            }
        }

        // Redirect to edit page
        return redirect()->route('property.show', $property);
    }

    public function render()
    {
        return view('livewire.property.create-property');
    }
}

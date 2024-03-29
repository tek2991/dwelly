<?php

namespace App\Http\Livewire\Property;

use App\Models\Property;
use App\Models\EstablishmentType;
use App\Models\NearbyEstablishment;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;


class AttachNearbyEstablishmentModal extends ModalComponent
{
    public $property_id;
    public $establishment_type_id;
    public $description;
    public $distance_in_kms;

    public Property $property;

    public $establishmentTypes;



    public function mount($property_id)
    {
        $this->property_id = $property_id;
        $this->property = Property::find($property_id);
        $this->establishmentTypes = EstablishmentType::all();
    }

    protected $rules = [
        'property_id' => 'required|exists:properties,id',
        'establishment_type_id' => 'required|exists:establishment_types,id',
        'description' => 'required|string|max:755',
        'distance_in_kms' => 'required|numeric',
    ];

    public function save()
    {
        if (Auth::user()->cannot('update', $this->property)) {
            abort(403, 'You are not authorized to edit property.');
        }
        $this->validate();
        
        NearbyEstablishment::create([
            'property_id' => $this->property_id,
            'establishment_type_id' => $this->establishment_type_id,
            'description' => $this->description,
            'distance_in_kms' => $this->distance_in_kms,
        ]);

        $this->emit('pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.property.attach-nearby-establishment-modal');
    }
}

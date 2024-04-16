<?php

namespace App\Http\Livewire\Property;

use App\Models\Property;
use App\Models\EstablishmentType;
use App\Models\NearbyEstablishment;
use LivewireUI\Modal\ModalComponent;

class RemoveNearbyEstablishmentModal extends ModalComponent
{
    public $property_id;
    public $nearby_establishment_id;
    public $establishmentTypes;
    public Property $property;
    public NearbyEstablishment $nearby_establishment;

    public $establishment_type_id;
    public $description;
    public $distance_in_kms;


    public function mount($property_id, $nearby_establishment_id)
    {
        $this->property_id = $property_id;
        $this->nearby_establishment_id = $nearby_establishment_id;
        $this->establishmentTypes = EstablishmentType::all();
        $this->property = Property::find($property_id);
        $this->nearby_establishment = NearbyEstablishment::find($nearby_establishment_id);

        $this->establishment_type_id = $this->nearby_establishment->establishment_type_id;
        $this->description = $this->nearby_establishment->description;
        $this->distance_in_kms = $this->nearby_establishment->distance_in_kms;
    }

    public function destroy()
    {
        $this->nearby_establishment->delete();

        $this->emit('pg:eventRefresh-default');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.property.remove-nearby-establishment-modal');
    }
}

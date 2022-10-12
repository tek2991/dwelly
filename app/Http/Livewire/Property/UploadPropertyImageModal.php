<?php

namespace App\Http\Livewire\Property;

use App\Models\Property;
use LivewireUI\Modal\ModalComponent;

class UploadPropertyImageModal extends ModalComponent
{
    public $property_id;
    public Property $property;


    public function mount($property_id)
    {
        $this->property_id = $property_id;
        $this->property = Property::find($property_id);
    }

    public function render()
    {
        return view('livewire.property.upload-property-image-modal');
    }
}

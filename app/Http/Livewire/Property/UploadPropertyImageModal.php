<?php

namespace App\Http\Livewire\Property;

use App\Models\Property;
use App\Models\PropertyImage;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Storage;

class UploadPropertyImageModal extends ModalComponent
{
    use WithFileUploads;

    public $property_id;
    public Property $property;

    public $uploads = [];


    public function mount($property_id)
    {
        $this->property_id = $property_id;
        $this->property = Property::find($property_id);
    }

    public function saveImages()
    {
        $this->validate([
            'uploads.*' => 'image|max:2048', // 2MB Max
        ]);

        foreach ($this->uploads as $image) {
            // Get last image order
            $lastOrder = $this->property->propertyImages()->orderBy('order', 'desc')->first() ? $this->property->propertyImages()->orderBy('order', 'desc')->first()->order : 0;
            $uid = uniqid();
            $image_name = $this->property->code . '_' . $uid . '.' . $image->extension();

            $image_path = $image->storeAs('public/properties/', $image_name, 'public');

            // $image_path = Storage::disk('public')->putFileAs('uploads/properties', $this->upload, $image_name);

            PropertyImage::create([
                'property_id' => $this->property_id,
                'image_path' => $image_path,
                'order' => $lastOrder + 1,
                'is_cover' => false,
                'show' => true,
            ]);
        }

        $this->emit('refreshPropertyImages');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.property.upload-property-image-modal');
    }
}

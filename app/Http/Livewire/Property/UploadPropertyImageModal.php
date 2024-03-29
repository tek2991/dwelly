<?php

namespace App\Http\Livewire\Property;

use App\Models\Property;
use App\Models\PropertyImage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::user()->cannot('update', $this->property)) {
            abort(403, 'You are not authorized to edit property.');
        }
        $this->validate([
            'uploads.*' => 'image|max:2048', // 2MB Max
        ]);

        foreach ($this->uploads as $image) {
            $lastOrder = $this->property->propertyImages()->orderBy('order', 'desc')->first() ? $this->property->propertyImages()->orderBy('order', 'desc')->first()->order : 0;
            $uid = uniqid();
            $image_name = $this->property->code . '_' . $uid . '.' . $image->extension();
            $image_path = $image->storeAs('uploads/properties/' . $this->property->code . '/images', $image_name, 'public');

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

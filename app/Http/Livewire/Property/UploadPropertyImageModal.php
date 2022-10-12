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

    public $upload;


    public function mount($property_id)
    {
        $this->property_id = $property_id;
        $this->property = Property::find($property_id);
    }

    public function saveImage()
    {
        $this->validate([
            'upload' => 'required|image|max:4096', // 4MB Max
        ]);

        // Get last image order
        $lastOrder = $this->property->images()->orderBy('order', 'desc')->first() ? $this->property->images()->orderBy('order', 'desc')->first()->order : 0;
        $uid = uniqid();
        $image_name = $this->property->code . '_' . $uid . '.' . $this->upload->getClientOriginalExtension();
        $image_path = Storage::disk('public')->putFileAs('uploads/properties', $this->upload, $image_name);

        PropertyImage::create([
            'property_id' => $this->property_id,
            'image_path' => $image_path,
            'order' => $lastOrder + 1,
            'is_cover' => false,
            'show' => true,
        ]);

        $this->emit('refreshPropertyImages');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.property.upload-property-image-modal');
    }
}

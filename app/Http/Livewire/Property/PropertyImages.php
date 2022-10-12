<?php

namespace App\Http\Livewire\Property;

use Livewire\Component;
use App\Models\Property;
use App\Models\PropertyImage;
use Livewire\WithFileUploads;

class PropertyImages extends Component
{
    use WithFileUploads;

    public $editing = false;
    public $updated = false;

    public Property $property;
    public $images;

    public $uploads = [];

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->images = PropertyImage::where('property_id', $property->id)->orderBy('order')->get();
    }

    public function updateImageOrder($list)
    {
        foreach ($list as $item) {
            $image = PropertyImage::find($item['value']);
            $image->order = $item['order'];
            $image->save();
        }

        $this->images = PropertyImage::where('property_id', $this->property->id)->orderBy('order')->get();
    }

    public function setCoverImage($image_id)
    {
        // Set all images to not cover image
        PropertyImage::where('property_id', $this->property->id)->update(['is_cover' => false]);

        // Set the selected image to cover image
        $image = PropertyImage::find($image_id);
        $image->is_cover = true;
        $image->save();

        $this->images = PropertyImage::where('property_id', $this->property->id)->orderBy('order')->get();
    }

    public function upload()
    {
        $this->validate([
            'uploads.*' => 'image|max:2024', // 2MB Max
        ]);

        foreach ($this->uploads as $upload) {
            $image = new PropertyImage();
            $image->property_id = $this->property->id;
            $image->image = $upload->store('public/properties');
            $image->save();
        }

        $this->uploads = [];
        $this->images = PropertyImage::where('property_id', $this->property->id)->orderBy('order')->get();
    }

    public function render()
    {
        return view('livewire.property.property-images');
    }
}

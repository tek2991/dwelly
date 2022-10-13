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

    // listeners
    protected $listeners = ['refreshPropertyImages' => 'refresh'];

    public function refresh()
    {
        $this->images = PropertyImage::where('property_id', $this->property->id)->orderBy('order')->get();
    }

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

        $this->refresh();
    }

    public function setCoverImage($image_id)
    {
        // Set all images to not cover image
        PropertyImage::where('property_id', $this->property->id)->update(['is_cover' => false]);

        // Set the selected image to cover image
        $image = PropertyImage::find($image_id);
        $image->is_cover = true;
        $image->show = true;
        $image->save();
        

        $this->refresh();
    }

    public function updateImageShow($image_id)
    {   
        // Do not allow toggle if image is cover image
        $image = PropertyImage::find($image_id);
        if ($image->is_cover) {
            return;
        }
        $image->show = !$image->show;
        $image->save();

        $this->refresh();
    }

    public function render()
    {
        return view('livewire.property.property-images');
    }
}

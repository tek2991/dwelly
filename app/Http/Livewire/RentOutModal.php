<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use App\Models\PropertyType;
use LivewireUI\Modal\ModalComponent;

class RentOutModal extends ModalComponent
{
    public $name;
    public $phone;
    public $email;
    public $num_of_properties = 1;

    public $property_types;

    public $property_type = [];
    public $bedroom = [];
    public $bathroom = [];
    public $availability = [];
    public $building_name;
    public $address;

    public $success = false;

    public function mount()
    {
        $this->property_types = PropertyType::all();
    }

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '3xl';
    }

    protected $rules = [
        'name' => 'required',
        'phone' => 'required',
        'email' => 'nullable|email',

        // Validation for property_type array
        'property_type.*' => 'required|exists:property_types,id',
        'bedroom.*' => 'required|integer',
        'bathroom.*' => 'required|integer',
        'availability.*' => 'required|boolean',
        'building_name.*' => 'required',
        'address.*' => 'required',
    ];


    public function submit()
    {
        $this->validate();

        // Create the contact
        $contact = Contact::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'message' => 'Rent Out',
        ]);

        // Create the rent outs
        for ($i = 0; $i < $this->num_of_properties; $i++) {
            // Check if the property_type does not have key $i
            if (!array_key_exists($i, $this->property_type)) {
                // Set the property_type of $i to 1
                $this->property_type[$i] = 1;
            }
            //  Check if the bedroom does not have key $i
            if (!array_key_exists($i, $this->bedroom)) {
                // Set the bedroom of $i to 1
                $this->bedroom[$i] = 1;
            }
            //  Check if the bathroom does not have key $i
            if (!array_key_exists($i, $this->bathroom)) {
                // Set the bathroom of $i to 1
                $this->bathroom[$i] = 1;
            }
            //  Check if the availability does not have key $i
            if (!array_key_exists($i, $this->availability)) {
                // Set the availability of $i to 1
                $this->availability[$i] = 1;
            }


            $contact->rentOuts()->create([
                'property_type_id' => $this->property_type[$i],
                'bedroom' => $this->bedroom[$i],
                'bathroom' => $this->bathroom[$i],
                'availability' => $this->availability[$i],
                'building_name' => $this->building_name[$i],
                'address' => $this->address[$i],
            ]);
        }

        $this->reset();

        $this->success = true;
    }

    public function render()
    {
        return view('livewire.rent-out-modal');
    }
}

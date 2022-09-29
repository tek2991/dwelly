<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use App\Models\Property;
use LivewireUI\Modal\ModalComponent;

class BookPropertyModal extends ModalComponent
{
    public $property_id;

    public $name;
    public $phone;
    public $email;
    public $message;

    // public $success = false;

    protected $rules = [
        'name' => 'required',
        'phone' => 'required',
        'email' => 'nullable|email',
        'message' => 'nullable|string|max:765',
    ];

    public function mount($property_id)
    {
        $this->property_id = $property_id;
    }

    public function submit()
    {
        $this->validate();

        // Create the contact

        $contact = Contact::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        // Sync the contact to the property
        $contact->property()->associate($this->property);

        $this->reset();

        $this->success = true;
    }

    public function render()
    {
        return view('livewire.book-property-modal');
    }
}

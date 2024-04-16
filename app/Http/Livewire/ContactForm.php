<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactForm extends Component
{
    public $name = 'test';
    public $phone;
    public $email;
    public $message;

    public $success = false;

    protected $rules = [
        'name' => 'required',
        'phone' => 'required',
        'email' => 'nullable|email',
        'message' => 'nullable|string|max:765',
    ];

    public function submit()
    {
        $this->validate();

        // Create the contact

        Contact::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        $this->reset();

        $this->success = true;
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}

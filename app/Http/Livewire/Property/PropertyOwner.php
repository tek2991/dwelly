<?php

namespace App\Http\Livewire\Property;

use App\Models\User;
use App\Models\Owner;
use Livewire\Component;
use App\Models\Property;

class PropertyOwner extends Component
{
    public $editing = false;
    public $updated = false;

    public Property $property;
    public Owner $owner;
    public User $user;

    public $name;
    public $email;
    public $phone_1;
    public $phone_2;
    public $onboarded_at;
    public $password;
    public $password_confirmation;

    public function mount(Owner $owner)
    {
        $this->owner = $owner;
        $this->property = $owner->property;
        $this->user = $owner->user;

        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone_1 = $this->user->phone_1;
        $this->phone_2 = $this->user->phone_2;

        $this->onboarded_at = $this->owner->onboarded_at->format('Y-m-d');
    }

    public function edit()
    {
        $this->editing = true;
        $this->updated = false;
    }

    public function cancel()
    {
        $this->editing = false;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users,email,' . $this->user->id,
            'phone_1' => 'required|string|max:25',
            'phone_2' => 'nullable|string|max:25',
            'onboarded_at' => 'required|date',
        ];
    }

    public function update()
    {
        $this->validate();

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone_1' => $this->phone_1,
            'phone_2' => $this->phone_2,
        ]);

        $this->owner->update([
            'onboarded_at' => $this->onboarded_at,
        ]);

        $this->editing = false;
        $this->updated = true;
    }

    public function render()
    {
        return view('livewire.property.property-owner');
    }
}

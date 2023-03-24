<?php

namespace App\Http\Livewire\Onboarding;

use App\Models\Owner;
use Livewire\Component;

class OwnerUpdate extends Component
{
    public $property;
    public $onboarding_id;
    public $owner;
    public $user;

    public $name;
    public $email;
    public $phone_1;
    public $phone_2;
    public $onboarded_at;
    public $password;
    public $password_confirmation;

    public $beneficiary_name;
    public $bank_name;
    public $ifsc;
    public $account_number;

    public $electricity_consumer_id_old;
    public $electricity_consumer_id_new;

    public function mount($property)
    {

        $this->property = $property;
        $this->onboarding_id = $property->onboarding->id;

        $this->user = $this->property->owner();
        $this->owner = Owner::where('user_id', $this->user->id)->where('property_id', $this->property->id)->first();
        
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone_1 = $this->user->phone_1;
        $this->phone_2 = $this->user->phone_2;
        
        $this->onboarded_at = $this->owner->onboarded_at->format('Y-m-d');

        $this->beneficiary_name = $this->owner->beneficiary_name;
        $this->bank_name = $this->owner->bank_name;
        $this->ifsc = $this->owner->ifsc;
        $this->account_number = $this->owner->account_number;

        $this->electricity_consumer_id_old = $this->owner->electricity_consumer_id_old;
        $this->electricity_consumer_id_new = $this->owner->electricity_consumer_id_new;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id,
            'phone_1' => 'required|string|max:25',
            'phone_2' => 'nullable|string|max:25',
            'onboarded_at' => 'required|date',

            'beneficiary_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'ifsc' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',

            'electricity_consumer_id_old' => 'nullable|string|max:255',
            'electricity_consumer_id_new' => 'nullable|string|max:255',
        ];
    }

    public function update()
    {
        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone_1' => $this->phone_1,
            'phone_2' => $this->phone_2,
        ]);

        $this->owner->update([
            'onboarded_at' => $this->onboarded_at,

            'beneficiary_name' => $this->beneficiary_name,
            'bank_name' => $this->bank_name,
            'ifsc' => $this->ifsc,
            'account_number' => $this->account_number,

            'electricity_consumer_id_old' => $this->electricity_consumer_id_old,
            'electricity_consumer_id_new' => $this->electricity_consumer_id_new,
        ]);
    }

    public function save()
    {
        $this->validate();

        $this->update();

        return redirect()->route('onboarding.show', $this->onboarding_id);
    }

    public function render()
    {
        return view('livewire.onboarding.owner-update');
    }
}

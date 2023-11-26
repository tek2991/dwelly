<?php

namespace App\Http\Livewire\Onboarding;

use App\Models\User;
use App\Models\Owner;
use Livewire\Component;

class OwnerCreate extends Component
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
    // public $password;
    // public $password_confirmation;

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
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
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

    public function generateRandomPassword($length = 12)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $special_characters = '!@#$%^&*()_-=+;:,.?';
        $password = '';
        $characterLength = strlen($characters);
        $special_characterLength = strlen($special_characters);

        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, $characterLength - 1)];
            $password .= $special_characters[rand(0, $special_characterLength - 1)];
        }

        return $password;
    }

    public function create()
    {
        $random_password = $this->generateRandomPassword();

            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone_1' => $this->phone_1,
                'phone_2' => $this->phone_2,
                'password' => bcrypt($random_password),
            ]);

        Owner::create([
            'user_id' => $user->id,
            'property_id' => $this->property->id,
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

        $this->create();

        $this->property->onboarding->update([
            'owner_data' => true,
        ]);

        return redirect()->route('onboarding.edit', $this->onboarding_id);
    }

    public function render()
    {
        return view('livewire.onboarding.owner-create');
    }
}

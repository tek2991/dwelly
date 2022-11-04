<?php

namespace App\Http\Livewire\Property;

use App\Models\User;
use App\Models\Tenant;
use Livewire\Component;
use App\Models\Property;

class PropertyTenant extends Component
{
    public $editing = false;
    public $updated = false;

    public Property $property;
    public Tenant $tenant;
    public User $user;

    public $name;
    public $email;
    public $phone_1;
    public $phone_2;
    public $onboarded_at;
    public $moved_in_at;
    public $moved_out_at;
    public $password;
    public $password_confirmation;

    public function mount(Tenant $tenant)
    {
        $this->tenant = $tenant;
        $this->property = $tenant->property;
        $this->user = $tenant->user;

        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone_1 = $this->user->phone_1;
        $this->phone_2 = $this->user->phone_2;

        $this->onboarded_at = $this->tenant->onboarded_at->format('Y-m-d');
        $this->moved_in_at = $this->tenant->moved_in_at ? $this->tenant->moved_in_at->format('Y-m-d') : null;
        $this->moved_out_at = $this->tenant->moved_out_at ? $this->tenant->moved_out_at->format('Y-m-d') : null;
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
            'moved_in_at' => 'nullable|date',
            'moved_out_at' => 'nullable|date',
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

        $this->tenant->update([
            'onboarded_at' => $this->onboarded_at,
            'moved_in_at' => $this->moved_in_at,
            'moved_out_at' => $this->moved_out_at,
        ]);

        $this->editing = false;
        $this->updated = true;
    }

    public function render()
    {
        return view('livewire.property.property-tenant');
    }
}

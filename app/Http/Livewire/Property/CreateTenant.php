<?php

namespace App\Http\Livewire\Property;

use App\Models\User;
use App\Models\Tenant;
use Livewire\Component;
use App\Models\Property;
use Illuminate\Support\Facades\Hash;

class CreateTenant extends Component
{
    public $editing = false;
    public $updated = false;

    public Property $property;

    public $name;
    public $email;
    public $phone_1;
    public $phone_2;
    public $onboarded_at;
    public $moved_in_at;
    public $moved_out_at;
    public $password;
    public $password_confirmation;
    public $is_primary;
    public $primary_tenant_id;

    public $primary_tenants;

    public function mount(Property $property)
    {
        $this->property = $property;

        $this->primary_tenants = Tenant::where('property_id', $this->property->id)->where('is_primary', true)->with('user')->get();
    }


    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users,email',
            'phone_1' => 'required|string|max:25',
            'phone_2' => 'nullable|string|max:25',
            'onboarded_at' => 'required|date',
            'moved_in_at' => 'nullable|date',
            'moved_out_at' => 'nullable|date',
            'password' => 'required|string|min:8|confirmed',
            'is_primary' => 'required|boolean',
            'primary_tenant_id' => 'required_if:is_primary,0',
        ];
    }

    public function updated($propertyName)
    {
        if($this->is_primary) {
            $this->primary_tenant_id = null;
        }
    }

    public function store()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone_1' => $this->phone_1,
            'phone_2' => $this->phone_2,
            'password' => Hash::make($this->password),
        ]);

        $tenant = Tenant::create([
            'property_id' => $this->property->id,
            'user_id' => $user->id,
            'onboarded_at' => $this->onboarded_at,
            'moved_in_at' => $this->moved_in_at,
            'moved_out_at' => $this->moved_out_at,
            'is_primary' => $this->is_primary,
            'primary_tenant_id' => $this->primary_tenant_id,
        ]);

        if($this->is_primary) {
            $tenant->primary_tenant_id = $tenant->id;
            $tenant->save();
        }

        return redirect()->route('tenant.show', [$tenant]);
    }

    public function render()
    {
        return view('livewire.property.create-tenant');
    }
}

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
    // public $password;
    // public $password_confirmation;
    public $is_primary;
    public $primary_tenant_id;

    public $primary_tenants;

    public function mount(Tenant $tenant)
    {
        $this->tenant = $tenant;
        $this->property = $tenant->property;
        $this->user = $tenant->user;

        $this->primary_tenants = Tenant::where('property_id', $this->property->id)->where('is_primary', true)->with('user')->get();

        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone_1 = $this->user->phone_1;
        $this->phone_2 = $this->user->phone_2;

        $this->onboarded_at = $this->tenant->onboarded_at->format('Y-m-d');
        $this->moved_in_at = $this->tenant->moved_in_at ? $this->tenant->moved_in_at->format('Y-m-d') : null;
        $this->moved_out_at = $this->tenant->moved_out_at ? $this->tenant->moved_out_at->format('Y-m-d') : null;

        $this->is_primary = $this->tenant->is_primary;
        $this->primary_tenant_id = $this->tenant->primary_tenant_id;
    }

    public function updated($propertyName)
    {
        if($this->is_primary) {
            $this->primary_tenant_id = null;
        }
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
            'is_primary' => 'required|boolean',
            'primary_tenant_id' => 'required_if:is_primary,0|integer|exists:tenants,id',
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

        if ($this->is_primary && !$this->tenant->is_primary) {
            // Get tenants with the same primary tenant id
            $tenant_ids = Tenant::where('primary_tenant_id', $this->tenant->primary_tenant_id)
                ->pluck('id');

            // Add primary tenant id to the tenant_ids
            $tenant_ids->push($this->tenant->id);

            // Update the primary tenant id to the current tenant
            Tenant::whereIn('id', $tenant_ids)->update([
                'primary_tenant_id' => $this->tenant->id,
                'is_primary' => false,
            ]);

            // Update the current tenant to be the primary tenant
            $this->tenant->update([
                'is_primary' => true,
            ]);
        }

        $this->editing = false;
        $this->updated = true;
    }

    public function render()
    {
        return view('livewire.property.property-tenant');
    }
}

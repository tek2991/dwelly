<?php

namespace App\Http\Livewire\Property;

use App\Models\User;
use App\Models\Tenant;
use Livewire\Component;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

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
    public $moved_in_at;
    public $moved_out_at;
    // public $password;
    // public $password_confirmation;
    public $is_primary;
    public $primary_tenant_id;

    public $beneficiary_name;
    public $bank_name;
    public $ifsc;
    public $account_number;

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

        $this->moved_in_at = $this->tenant->moved_in_at ? $this->tenant->moved_in_at->format('Y-m-d') : null;
        $this->moved_out_at = $this->tenant->moved_out_at ? $this->tenant->moved_out_at->format('Y-m-d') : null;

        $this->is_primary = $this->tenant->is_primary;
        $this->primary_tenant_id = $this->tenant->primary_tenant_id;

        $this->beneficiary_name = $this->tenant->beneficiary_name;
        $this->bank_name = $this->tenant->bank_name;
        $this->ifsc = $this->tenant->ifsc;
        $this->account_number = $this->tenant->account_number;
    }

    public function updated($propertyName)
    {
        if($this->is_primary) {
            $this->primary_tenant_id = null;
        }
    }

    public function edit()
    {
        if (Auth::user()->cannot('update', $this->tenant)) {
            abort(403, 'You are not authorized to edit tenant.');
        }
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
            'moved_in_at' => 'nullable|date',
            'moved_out_at' => 'nullable|date',
            'is_primary' => 'required|boolean',
            'primary_tenant_id' => 'required_if:is_primary,0',

            // 'beneficiary_name' => 'nullable|string|max:255',
            // 'bank_name' => 'nullable|string|max:255',
            // 'ifsc' => 'nullable|string|max:255',
            // 'account_number' => 'nullable|string|max:255',
        ];
    }

    public function update()
    {
        if (Auth::user()->cannot('update', $this->tenant)) {
            abort(403, 'You are not authorized to edit tenant.');
        }
        $this->validate();

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone_1' => $this->phone_1,
            'phone_2' => $this->phone_2,
        ]);

        $this->tenant->update([
            'moved_in_at' => $this->moved_in_at,
            'moved_out_at' => $this->moved_out_at,
            
            // 'beneficiary_name' => $this->beneficiary_name,
            // 'bank_name' => $this->bank_name,
            // 'ifsc' => $this->ifsc,
            // 'account_number' => $this->account_number,
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
        }else{
            $this->tenant->update([
                'is_primary' => $this->is_primary,
                'primary_tenant_id' => $this->primary_tenant_id,
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

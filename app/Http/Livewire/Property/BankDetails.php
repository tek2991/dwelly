<?php

namespace App\Http\Livewire\Property;

use Livewire\Component;

class BankDetails extends Component
{
    public $owner_or_tenant = null;

    public $beneficiary_name;
    public $bank_name;
    public $ifsc;
    public $account_number;
    public $is_current;

    public function mount($owner_or_tenant)
    {
        $this->owner_or_tenant = $owner_or_tenant;
    }


    public function render()
    {
        return view('livewire.property.bank-details');
    }
}

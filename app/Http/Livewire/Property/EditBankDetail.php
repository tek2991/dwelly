<?php

namespace App\Http\Livewire\Property;

use App\Models\Owner;
use Livewire\Component;
use App\Models\DocumentType;
use Livewire\WithFileUploads;

class EditBankDetail extends Component
{
    use WithFileUploads;

    public $type = 'null';
    public $owner_or_tenant = null;

    public $user = null;

    // public $document_types = [];

    public $beneficiary_name;
    public $bank_name;
    public $ifsc;
    public $account_number;
    public $is_current;
    // public $document_type_id;

    // public $document;

    public function mount($bankDetail)
    {
        // If the owner_or_tenant is an owner Model
        if ($bankDetail->bankable instanceof Owner) {
            $this->type = 'owner';
        } else {
            $this->type = 'tenant';
        }

        $this->owner_or_tenant = $bankDetail->bankable;

        $this->user = $bankDetail->bankable->user;
        // $this->document_types = DocumentType::all();

        $this->beneficiary_name = $bankDetail->beneficiary_name;
        $this->bank_name = $bankDetail->bank_name;
        $this->ifsc = $bankDetail->ifsc;
        $this->account_number = $bankDetail->account_number;
        $this->is_current = $bankDetail->is_current;
    }

    protected function rules()
    {
        return [
            'beneficiary_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'ifsc' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'is_current' => 'required|boolean',
            // 'document_type_id' => 'required|exists:document_types,id',
        ];
    }

    // public function updatedDocument($document)
    // {
    //     $this->validateOnly($document, [
    //         'document' => 'required|file|mimes:pdf|max:10240',
    //     ]);
    // }

    public function store()
    {
        $this->validate();

        // Update Bank Detail
        



        // If current bank detail is set to true, update all other bank details for the user to false
        if ($this->is_current) {

        }

        // Create Document against the owner or tenant
        // if ($this->document) {
        //     $this->owner_or_tenant->documents()->create([
        //         'document_type_id' => $this->document_type_id,
        //         'file_path' => $this->document->store('documents/bank_details/' . $this->type . '/' . $this->owner_or_tenant->id, 'public'),
        //     ]);
        // }

        // redirect to the owner or tenant detail page
        $this->redirectToBankDetail();
    }

    public function redirectToBankDetail()
    {
        // If the owner_or_tenant is an owner Model
        if ($this->type === 'owner') {
            return redirect()->route('owner.edit', $this->owner_or_tenant);
        } else {
            return redirect()->route('tenant.edit', $this->owner_or_tenant);
        }
    }

    public function render()
    {
        return view('livewire.property.create-bank-detail');
    }
}

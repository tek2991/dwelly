<?php

namespace App\Http\Livewire\Property;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Tenant;
use App\Models\Property;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class UploadTenantDocumentModal extends ModalComponent
{
    use WithFileUploads;

    public $tenant_id;
    public Tenant $tenant;
    public Property $property;
    public $documentTypes;

    public $document_type_id;
    public $file;

    public function mount($tenant_id)
    {
        $this->tenant_id = $tenant_id;
        $this->tenant = Tenant::find($tenant_id);
        $this->property = Property::find($this->tenant->property_id);
        $this->documentTypes = DocumentType::all();
    }

    public function saveDocument()
    {
        $this->validate([
            'file' => 'max:4096', // 4MB Max
            'document_type_id' => 'required|exists:document_types,id',
        ]);

        $uid = uniqid();
        $file_name = $this->property->code . '_' . $uid . '.' . $this->file->extension();
        $file_path = $this->file->storeAs('uploads/properties/' . $this->property->code . 'documents/tenant/'. $this->tenant_id, $file_name, 'public');

        $this->tenant->documents()->create([
            'document_type_id' => $this->document_type_id,
            'file_name' => $file_name,
            'file_path' => $file_path,
        ]);

        $this->emit('pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.property.upload-tenant-document-modal');
    }
}

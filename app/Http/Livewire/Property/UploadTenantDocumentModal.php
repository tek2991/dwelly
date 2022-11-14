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
    public $tenants;

    public $document_type_id;
    public $file;
    public $selected_tenant_id;

    public function mount($tenant_id)
    {
        $this->tenant_id = $tenant_id;
        $this->tenant = Tenant::find($tenant_id);
        $this->property = Property::find($this->tenant->property_id);
        $this->documentTypes = DocumentType::all();

        $this->tenants = Tenant::where('primary_tenant_id', $this->tenant->primary_tenant_id)->with('user')->get();
    }

    public function saveDocument()
    {
        $this->validate([
            'file' => 'max:4096', // 4MB Max
            'document_type_id' => 'required|exists:document_types,id',
            'selected_tenant_id' => 'required|exists:tenants,id',
        ]);

        $uid = uniqid();
        $file_name = $this->property->code . '_' . $uid . '.' . $this->file->extension();
        $file_path = $this->file->storeAs('uploads/properties/' . $this->property->code . 'documents/tenant/'. $this->tenant_id, $file_name, 'public');

        Document::create([
            'document_type_id' => $this->document_type_id,
            'file_name' => $file_name,
            'file_path' => $file_path,
            'tenant_id' => $this->selected_tenant_id,
        ]);

        $this->emit('pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.property.upload-tenant-document-modal');
    }
}

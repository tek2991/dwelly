<?php

namespace App\Http\Livewire\Property;

use App\Models\Owner;
use App\Models\Document;
use App\Models\Property;
use App\Models\DocumentType;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class UploadOwnerDocumentModal extends ModalComponent
{
    use WithFileUploads;

    public $owner_id;
    public Owner $owner;
    public Property $property;
    public $documentTypes;

    public $document_type_id;
    public $file;

    public function mount($owner_id)
    {
        $this->owner_id = $owner_id;
        $this->owner = Owner::find($owner_id);
        $this->property = Property::find($this->owner->property_id);
        $this->documentTypes = DocumentType::all();
    }

    public function saveDocument()
    {
        if (Auth::user()->cannot('update', $this->owner)) {
            abort(403, 'You are not authorized to edit owners data.');
        }
        $this->validate([
            'file' => 'max:4096', // 4MB Max
            'document_type_id' => 'required|exists:document_types,id',
        ]);

        $uid = uniqid();
        $file_name = $this->property->code . '_' . $uid . '.' . $this->file->extension();
        $file_path = $this->file->storeAs('uploads/properties/' . $this->property->code . '/documents/owner/' . $this->owner_id, $file_name, 'public');

        $this->owner->documents()->create([
            'document_type_id' => $this->document_type_id,
            'file_name' => $file_name,
            'file_path' => $file_path,
        ]);

        $this->emit('pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.property.upload-owner-document-modal');
    }
}

<?php

namespace App\Http\Livewire\Property;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Property;
use LivewireUI\Modal\ModalComponent;

class RemoveOwnerDocumentModal extends ModalComponent
{
    public $document_id;
    public Document $document;
    public Property $property;
    public $document_types;
    public $document_type_id;


    public function mount($document_id)
    {
        $this->document_id = $document_id;
        $this->document = Document::find($document_id);
        $owner = $this->document->documentable;
        $this->property = Property::find($owner->property_id);
        $this->document_types = DocumentType::all();
        $this->document_type_id = $this->document->document_type_id;

    }

    public function destroy()
    {
        $file_path = $this->document->file_path;
        // Delete the file from the storage
        \Storage::disk('public')->delete($file_path);
        $this->document->delete();
        $this->emit('pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.property.remove-owner-document-modal');
    }
}

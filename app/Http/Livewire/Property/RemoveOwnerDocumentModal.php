<?php

namespace App\Http\Livewire\Property;

use App\Models\Document;
use App\Models\Property;
use App\Models\DocumentType;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class RemoveOwnerDocumentModal extends ModalComponent
{
    public $document_id;
    public Document $document;
    public Property $property;
    public $document_types;
    public $document_type_id;
    public $owner;


    public function mount($document_id)
    {
        $this->document_id = $document_id;
        $this->document = Document::find($document_id);
        $this->owner = $this->document->documentable;
        $this->property = Property::find($this->owner->property_id);
        $this->document_types = DocumentType::all();
        $this->document_type_id = $this->document->document_type_id;
    }

    public function destroy()
    {
        if (Auth::user()->cannot('update', $this->tenant)) {
            abort(403, 'You are not authorized to edit tenants data.');
        }
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

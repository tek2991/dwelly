<?php

namespace App\Http\Livewire\Property;

use App\Models\Document;
use App\Models\Owner;
use App\Models\Property;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class UploadOwnerDocumentModal extends ModalComponent
{
    use WithFileUploads;

    public $owner_id;
    public Owner $owner;
    public Property $property;

    public $document_type_id;
    public $file;

    public function mount($owner_id)
    {
        $this->owner_id = $owner_id;
        $this->owner = Owner::find($owner_id);
        $this->property = Property::find($this->owner->property_id);
    }

    public function saveDocument()
    {
        $this->validate([
            'file' => 'max:2048', // 2MB Max
        ]);

        $uid = uniqid();
        $file_name = $this->property->code . '_' . $uid . '.' . $this->file->extension();
        $file_path = $this->file->storeAs('uploads/documents/' . $this->property->code . '/', $file_name, 'public');

        Document::create([

        ]);

        $this->emit('refreshOwnerDocuments');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.property.upload-owner-document-modal');
    }
}

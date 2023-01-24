<?php

namespace App\Http\Livewire\Audit;

use App\Models\Property;
use Livewire\WithFileUploads;
use App\Models\AuditChecklist;
use LivewireUI\Modal\ModalComponent;

class UploadImageModal extends ModalComponent
{
    use WithFileUploads;

    public $auditChecklist;
    public $audit;
    public $property;
    public $image;
    public $remarks;

    public function mount($checklist_id)
    {
        $this->auditChecklist = AuditChecklist::find($checklist_id);
        $this->audit = $this->auditChecklist->audit;
        $this->property = Property::find($this->auditChecklist->audit->property_id);
    }

    public function saveImage()
    {
        $this->validate([
            'image' => 'image|max:2048', // 2MB Max
            'remarks' => 'nullable|string',
        ]);

        $uid = uniqid();
        $image_name = $this->property != null ? $this->property->code . '_' . $uid . '.' . $this->image->extension() : $uid . '.' . $this->image->extension();
        $path = $this->property != null ? 'uploads/properties/' . $this->property->code . '/audits/' . $this->audit->id : 'uploads/audits/' . $this->audit->id;
        $file_path = $this->image->storeAs($path, $image_name, 'public');

        $this->auditChecklist->uploads()->create([
            'file_type' => 'image',
            'file_path' => $file_path,
            'remarks' => $this->remarks,
        ]);

        $this->emit('refreshAuditUploads');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.audit.upload-image-modal');
    }
}

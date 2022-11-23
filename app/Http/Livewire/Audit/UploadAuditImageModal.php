<?php

namespace App\Http\Livewire\Audit;

use App\Models\Audit;
use App\Models\Property;
use App\Models\AuditMedia;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class UploadAuditImageModal extends ModalComponent
{
    use WithFileUploads;

    public Audit $audit;
    public $image;

    public function mount($audit_id)
    {
        $this->audit = Audit::find($audit_id);
    }

    public function saveImages()
    {
        $this->validate([
            'image' => 'image|max:2048', // 2MB Max
            'remarks' => 'nullable|string|max:2550',
        ]);

        $uid = uniqid();
        $image_name = $this->audit->id . '_' . $uid . '.' . $this->image->extension();
        $property_code = $this->audit->property->code;
        $audit_type_name = Str::slug($this->audit->auditType->name);
        $audit_date = $this->audit->audit_date;
        $image_path = $this->image->storeAs('uploads/properties/' . $property_code . '/audits/' . $audit_type_name . '/' . $audit_date, $image_name, 'public');

        AuditMedia::create([
            'audit_id' => $this->audit->id,
            'media_path' => $image_path,
            'media_type' => 'image',
            'remarks' => $this->remarks,
        ]);

        $this->emit('refreshAuditMedias');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.audit.upload-audit-image-modal');
    }
}

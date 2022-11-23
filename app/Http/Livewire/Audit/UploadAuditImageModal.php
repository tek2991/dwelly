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
    public $uploads = [];

    public function mount($audit_id)
    {
        $this->audit = Audit::find($audit_id);
    }

    public function saveImages()
    {
        $this->validate([
            'uploads.*' => 'image|max:2048', // 2MB Max
        ]);

        foreach ($this->uploads as $image) {
            $uid = uniqid();
            $image_name = $this->aduit->id . '_' . $uid . '.' . $image->extension();
            $property_code = $this->audit->property->code;
            $audit_type_name = Str::slug($this->audit->auditType->name);
            $audit_date = $this->audit->audit_date;
            $image_path = $image->storeAs('uploads/properties/' . $property_code . '/audits/' . $audit_type_name . '/' . $audit_date . '/' . $image_name, 'public');

            AuditMedia::create([
                'audit_id' => $this->audit->id,
                'media_path' => $image_path,
                'media_type' => 'image',
            ]);
        }

        $this->emit('refreshAuditMedias');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.audit.upload-audit-image-modal');
    }
}

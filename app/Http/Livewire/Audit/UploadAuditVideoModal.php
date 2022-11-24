<?php

namespace App\Http\Livewire\Audit;

use App\Models\Audit;
use App\Models\Property;
use App\Models\AuditMedia;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class UploadAuditVideoModal extends ModalComponent
{
    use WithFileUploads;

    public Audit $audit;
    public $video;
    public $remarks;

    public function mount($audit_id)
    {
        $this->audit = Audit::find($audit_id);
    }

    public function savevideos()
    {
        if($this->editable === false) {
            $this->err = 'This audit is not editable.';
            return;
        }
        
        $this->validate([
            'video' => 'mimes:mp4,mov,ogg,qt|max:131072', // 128MB Max
            'remarks' => 'nullable|string|max:2550',
        ]);

        $uid = uniqid();
        $video_name = $this->audit->id . '_' . $uid . '.' . $this->video->extension();
        $property_code = $this->audit->property->code;
        $audit_type_name = Str::slug($this->audit->auditType->name);
        $audit_date = $this->audit->audit_date;
        $video_path = $this->video->storeAs('uploads/properties/' . $property_code . '/audits/' . $audit_type_name . '/' . $audit_date, $video_name, 'public');

        AuditMedia::create([
            'audit_id' => $this->audit->id,
            'media_path' => $video_path,
            'media_type' => 'video',
            'remarks' => $this->remarks,
        ]);

        $this->emit('refreshAuditMedias');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.audit.upload-audit-video-modal');
    }
}

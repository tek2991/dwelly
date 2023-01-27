<?php

namespace App\Http\Livewire\Audit;

use App\Models\Property;
use Livewire\WithFileUploads;
use App\Models\AuditChecklist;
use LivewireUI\Modal\ModalComponent;

class UploadVideoModal extends ModalComponent
{
    use WithFileUploads;

    public $auditChecklist;
    public $audit;
    public $property;
    public $video;
    public $remarks;

    public function mount($checklist_id)
    {
        $this->auditChecklist = AuditChecklist::find($checklist_id);
        $this->audit = $this->auditChecklist->audit;
        $this->property = Property::find($this->auditChecklist->audit->property_id);
    }

    public function saveVideo()
    {
        $this->validate([
            'video' => 'required|file|mimes:mp4,mov,ogg,qt,webm|max:10240', // 10MB Max
            'remarks' => 'nullable|string',
        ]);

        $uid = uniqid();
        $video_name = $this->property != null ? $this->property->code . '_' . $uid . '.' . $this->video->extension() : $uid . '.' . $this->video->extension();
        $path = $this->property != null ? 'uploads/properties/' . $this->property->code . '/audits/' . $this->audit->id : 'uploads/audits/' . $this->audit->id;
        $file_path = $this->video->storeAs($path, $video_name, 'public');

        $this->auditChecklist->uploads()->create([
            'file_type' => 'video',
            'file_path' => $file_path,
            'remarks' => $this->remarks,
        ]);

        $this->emit('refreshAuditUploads');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.audit.upload-video-modal');
    }
}

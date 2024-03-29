<?php

namespace App\Http\Livewire\Audit;

use App\Models\Property;
use Livewire\WithFileUploads;
use App\Models\AuditChecklist;
use LivewireUI\Modal\ModalComponent;
use App\Actions\Helpers\UpdateTaskState;

class UploadImageModal extends ModalComponent
{
    use WithFileUploads;

    public $auditChecklist;
    public $audit;
    public $property;
    public $image;
    public $remarks;
    public $condition;

    public function mount($checklist_id)
    {
        $this->auditChecklist = AuditChecklist::find($checklist_id);
        $this->audit = $this->auditChecklist->audit;
        $this->property = Property::find($this->auditChecklist->audit->property_id);
    }

    public function rules()
    {
        return [
            'image' => 'required|image|max:2048', // 2MB Max
            'remarks' => 'nullable|string',
            'condition' => 'required|boolean',
        ];
    }

    public function saveImage()
    {
        $this->validate();

        $uid = uniqid();
        $image_name = $this->property != null ? $this->property->code . '_' . $uid . '.' . $this->image->extension() : $uid . '.' . $this->image->extension();
        $path = $this->property != null ? 'uploads/properties/' . $this->property->code . '/audits/' . $this->audit->id : 'uploads/audits/' . $this->audit->id;
        $file_path = $this->image->storeAs($path, $image_name, 'public');

        $this->auditChecklist->uploads()->create([
            'file_type' => 'image',
            'file_path' => $file_path,
            'remarks' => $this->remarks,
            'condition' => $this->condition,
        ]);

        $this->updateTaskState();

        $this->emit('refreshAuditUploads');
        $this->closeModal();
    }

    public function updateTaskState()
    {
        $task = $this->audit->task;
        // Update the task state
        UpdateTaskState::update($task, 2);
    }

    public function render()
    {
        return view('livewire.audit.upload-image-modal');
    }
}

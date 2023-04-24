<?php

namespace App\Http\Livewire\Task;

use Livewire\Component;

class TaskComplete extends Component
{
    public $task;
    public $audit = null;

    public $confirm = false;

    public $editable = false;
    public $editing = false;
    public $updated = false;
    public $err = null;

    public function mount($task)
    {
        $this->task = $task;
        $this->editable = $this->task->taskState->name === 'Completed' ? false : true;

        if ($this->task->taskable instanceof \App\Models\Audit) {
            $this->audit = $this->task->taskable;

        }
        if ($this->task->completed()) {
            $this->confirm = true;
        }
    }

    public function cancel()
    {
        $this->editing = false;
    }

    public function edit()
    {
        if ($this->editable) {
            $this->editing = true;
            $this->updated = false;
        } else {
            $this->err = 'You cannot edit this audit';
        }
    }

    public function rules()
    {
        return [
            'confirm' => 'required|accepted',
        ];
    }

    public function completeTask()
    {
        $this->validate();

        if ($this->task->taskable instanceof \App\Models\Audit) {
            if($this->audit->completed !== true) {
                $this->err = 'Audit must be completed before completing this task.';
                return;
            }
        }

        if ($this->task->completed()) {
            $this->err = 'Task already completed.';
            return;
        }

        $this->task->complete();

        // emit
        $this->emit('refreshTaskCompleted');

        $this->editable = false;
    }

    public function disable()
    {
        $this->editable = false;
    }

    public function render()
    {
        return view('livewire.task.task-complete');
    }
}

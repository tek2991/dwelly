<?php

namespace App\Http\Livewire\Task;

use App\Models\User;
use Livewire\Component;
use App\Models\Priority;
use App\Models\TaskState;

class TaskDescription extends Component
{
    public $task;
    public $priorities;
    public $usersWithPerms = [];

    public $description;
    public $priority_id;
    public $assigned_to;

    public $editable = false;
    public $editing = false;
    public $updated = false;
    public $err = null;

    public function mount($task)
    {
        $this->task = $task;
        $this->priorities = Priority::all();
        if($this->task->taskable instanceof \App\Models\Audit) {
            $this->usersWithPerms = User::permission('edit audit')->get();
        } else {
            $this->usersWithPerms = User::permission('edit onboarding')->get();
        }


        $this->description = $task->description;
        $this->priority_id = $task->priority_id;
        $this->assigned_to = $task->assigned_to;

        $this->editable = $this->task->taskState->name === 'Completed' ? false : true;

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
            'description' => 'required|string',
            'priority_id' => 'required|exists:priorities,id',
            'assigned_to' => 'required|exists:users,id',
        ];
    }

    public function update()
    {
        $this->validate();

        $this->task->update([
            'description' => $this->description,
            'priority_id' => $this->priority_id,
            'assigned_to' => $this->assigned_to,
        ]);

        $this->editing = false;
        $this->updated = true;
    }

    public function disable()
    {
        $this->editable = false;
    }

    public function render()
    {
        return view('livewire.task.task-description');
    }
}

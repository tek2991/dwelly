<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Priority;
use App\Models\TaskState;

class CreateTask extends Component
{
    public $taskStates;
    public $priorities;
    public $usersWithPerms;

    public $taskables = [
        'Onboarding' => 'App\Models\Onboarding',
        'Audit' => 'App\Models\Audit',
    ];

    public $description;
    public $taskStateId;
    public $priorityId;
    public $dueDate;
    public $assignedTo;
    public $createdBy;
    public $taskableType;

    public $err = null;
    public $disable_submit = true;

    public function mount()
    {
        $this->taskStates = TaskState::all();
        $this->priorities = Priority::all();
    }

    public function updatedTaskableType($value)
    {
        $this->usersWithPerms = $this->taskableType == 'Onboarding'
            ? User::permission('add onboarding')->get()
            : User::permission('add audit')->get();
    }

    public function rules()
    {
        return [
            'description' => 'required|string',
            'taskStateId' => 'required|exists:task_states,id',
            'priorityId' => 'required|exists:priorities,id',
            'dueDate' => 'required|date',
            'assignedTo' => 'required|exists:users,id',
            'createdBy' => 'required|exists:users,id',
            'taskableType' => 'required|string|in:' . implode(',', $this->taskables),
        ];
    }

    public function store()
    {
        $this->validate();


    }

    public function render()
    {
        return view('livewire.create-task');
    }
}

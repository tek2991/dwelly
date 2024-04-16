<?php

namespace App\Http\Livewire\Task;

use Livewire\Component;

class ReopenAudit extends Component
{
    public $task;
    public $audit;

    public $confirm = false;

    public $editable = false;
    public $editing = false;
    public $updated = false;
    public $err = null;

    public function mount($task)
    {
        $this->task = $task;
        $this->audit = $task->taskable;
        $this->editable = $this->audit->completed == true;
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

    public function reopenAudit()
    {
        $this->validate();

        if ($this->task->taskable instanceof \App\Models\Audit) {
            if($this->audit->completed !== true) {
                $this->err = 'Audit is not completed.';
                return;
            }
        }

        if ($this->task->completed()) {
            $this->err = 'Task already completed.';
            return;
        }

        $this->audit->completed = false;
        $this->audit->save();

        // emit
        $this->emit('refreshReopenedAudit');

        $this->editable = false;
    }

    public function disable()
    {
        $this->editable = false;
    }

    public function render()
    {
        return view('livewire.task.reopen-audit');
    }
}

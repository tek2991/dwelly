<?php

// Class to update the task_state_id of a task model

namespace App\Actions\Helpers;

use App\Models\Task;

class UpdateTaskState
{
    public static function update(Task $task, $state)
    {
        $task->task_state_id = $state;
        $task->save();
    }
}
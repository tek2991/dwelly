<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'description',
        'task_state_id',
        'priority_id',
        'due_date',
        'assigned_to',
        'created_by',
        'taskable_id',
        'taskable_type',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function taskState()
    {
        return $this->belongsTo(TaskState::class);
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function taskable()
    {
        return $this->morphTo();
    }
}

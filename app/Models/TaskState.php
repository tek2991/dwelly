<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskState extends Model
{
    protected $fillable = [
        'name',
    ];

    public function defaultStates()
    {
        return [
            'New',
            'In Progress',
            'Completed',
            'Cancelled',
        ];
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}

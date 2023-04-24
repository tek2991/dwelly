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
            'Created',
            'In Progress',
            'Submitted',
            'Completed',
        ];
    }


    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function completed()
    {
        return $this->name === 'Completed';
    }
}

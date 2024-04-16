<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $table = 'priorities';

    protected $fillable = [
        'name',
    ];

    public function defaultPriorities()
    {
        return [
            'High',
            'Normal',
            'Low',
        ];
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = [
        'file_type',
        'file_path',
        'uploadable_id',
        'uploadable_type',
        'remarks',
    ];

    public function uploadable()
    {
        return $this->morphTo();
    }

    public function auditChecklist()
    {
        return $this->morphedByMany(AuditChecklist::class, 'uploadable');
    }
}

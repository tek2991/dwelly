<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditChecklist extends Model
{
    protected $fillable = [
        'audit_id',
        'checklistable_id',
        'checklistable_type',
        'good',
        'bad',
        'total',
    ];

    protected $casts = [
        'good' => 'integer',
        'bad' => 'integer',
    ];

    public function audit()
    {
        return $this->belongsTo(Audit::class);
    }

    public function checklistable()
    {
        return $this->morphTo();
    }
}

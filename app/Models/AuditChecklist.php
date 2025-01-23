<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditChecklist extends Model
{
    protected $fillable = [
        'audit_id',
        'checklistable_id',
        'checklistable_type',
        'is_primary',
        'primary_audit_checklist_id',
        'remarks',
        'name',
        'completed',
        // 'verified',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'completed' => 'boolean',
        // 'verified' => 'boolean',
    ];

    public function audit()
    {
        return $this->belongsTo(Audit::class);
    }

    public function checklistable()
    {
        return $this->morphTo();
    }

    public function furniture()
    {
        return $this->morphedByMany(Furniture::class, 'checklistable');
    }

    public function room()
    {
        return $this->morphedByMany(Room::class, 'checklistable');
    }

    public function primaryAuditChecklist()
    {
        return $this->belongsTo(AuditChecklist::class, 'primary_audit_checklist_id');
    }

    public function secondaryAuditChecklists()
    {
        return $this->hasMany(AuditChecklist::class, 'primary_audit_checklist_id');
    }

    public function uploads()
    {
        return $this->morphMany(Upload::class, 'uploadable');
    }
}

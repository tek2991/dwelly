<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Onboarding extends Model
{
    protected $fillable = [
        'property_id',
        'property_data',
        'owner_data',
        'amenities_data',
        'rooms_data',
        'furnitures_data',
        'audit_id',
        'completed',
    ];

    protected $casts = [
        'property_data' => 'boolean',
        'owner_data' => 'boolean',
        'amenities_data' => 'boolean',
        'rooms_data' => 'boolean',
        'furnitures_data' => 'boolean',
        'completed' => 'boolean',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }

    public function audit()
    {
        return $this->belongsTo(Audit::class, 'audit_id', 'id');
    }

    public function auditCompleted()
    {
        if ($this->audit()->exists()) {
            return $this->audit->completed;
        }
        return false;
    }

    public function canStartAudit()
    {
        return $this->property_data && $this->owner_data && $this->amenities_data && $this->rooms_data && $this->furnitures_data;
    }

    public function canBeCompleted()
    {
        return $this->canStartAudit() && $this->auditCompleted();
    }

    public function task()
    {
        return $this->morphOne(Task::class, 'taskable');
    }
}

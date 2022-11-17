<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $fillable = [
        'audit_date',
        'audit_type_id',
        'property_id',
        'created_by',
        'updated_by',
        'tenant_id',
        'completed',
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function auditType()
    {
        return $this->belongsTo(AuditType::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    

    public function auditChecklists()
    {
        return $this->hasMany(AuditChecklist::class);
    }

    public function auditMedias()
    {
        return $this->hasMany(AuditMedia::class);
    }
}

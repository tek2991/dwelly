<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'user_id',
        'property_id',
        'moved_in_at',
        'moved_out_at',
        'is_primary',
        'primary_tenant_id',

        'beneficiary_name',
        'bank_name',
        'ifsc',
        'account_number',
    ];

    protected $dates = [
        'moved_in_at',
        'moved_out_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function primaryTenant()
    {
        return $this->belongsTo(Tenant::class, 'primary_tenant_id');
    }

    public function secondaryTenants()
    {
        return $this->hasMany(Tenant::class, 'primary_tenant_id');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable')->with('documentType');
    }

    public function audits()
    {
        return $this->hasMany(Audit::class);
    }

    public function hasMoveInAudit()
    {
        $moveInTypeId = AuditType::where('name', 'Move In')->first()->id;
        return $this->audits()->where('audit_type_id', $moveInTypeId)->exists();
    }

    public function hasMoveOutAudit()
    {
        $moveOutTypeId = AuditType::where('name', 'Move Out')->first()->id;
        return $this->audits()->where('audit_type_id', $moveOutTypeId)->exists();
    }

    public function bankDetails()
    {
        return $this->morphMany(BankDetail::class, 'bankable');
    }
}

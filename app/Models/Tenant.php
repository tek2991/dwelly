<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'user_id',
        'property_id',
        'onboarded_at',
        'moved_in_at',
        'moved_out_at',
        'is_primary',
        'primary_tenant_id',
    ];

    protected $dates = [
        'onboarded_at',
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
}

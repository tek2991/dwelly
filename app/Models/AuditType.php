<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditType extends Model
{
    protected $fillable = [
        'name',
    ];

    public static function defaultTypes()
    {
        return [
            'Property Onboarding',
            'Property De-boarding',
            'Move In',
            'Move Out',
            'Operational',
        ];
    }

    public function audits()
    {
        return $this->hasMany(Audit::class);
    }
}

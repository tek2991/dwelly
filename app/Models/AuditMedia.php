<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditMedia extends Model
{
    protected $table = 'audit_medias';
    protected $fillable = [
        'audit_id',
        'media_path',
        'media_type',
        'remarks',
    ];

    public function audit()
    {
        return $this->belongsTo(Audit::class);
    }
}

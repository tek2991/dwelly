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

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable')->with('documentType');
    }
}

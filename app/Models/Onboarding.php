<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Onboarding extends Model
{
    protected $fillable = [
        'property_id',
        'property',
        'owner',
        'amenities',
        'rooms',
        'furnitures',
        'completed',
    ];

    protected $casts = [
        'property' => 'boolean',
        'owner' => 'boolean',
        'amenities' => 'boolean',
        'rooms' => 'boolean',
        'furnitures' => 'boolean',
        'completed' => 'boolean',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}

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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    protected $fillable = [
        'property_id',
        'image_path',
        'order',
        'is_cover',
        'show',
    ];

    protected $casts = [
        'is_cover' => 'boolean',
        'show' => 'boolean',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}

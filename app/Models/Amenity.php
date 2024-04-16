<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    protected $fillable = [
        'name',
        'icon_path',
        'show',
    ];

    protected $casts = [
        'show' => 'boolean',
    ];

    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }
}

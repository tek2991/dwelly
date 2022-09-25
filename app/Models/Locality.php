<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    protected $fillable = [
        'name',
        'pincode',
        'city',
    ];

    protected $casts = [
        'show' => 'boolean',
    ];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function hasProperties(){
        return $this->properties()->count() > 0;
    }
}

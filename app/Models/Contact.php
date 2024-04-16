<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'property_id',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function rentOuts()
    {
        return $this->hasMany(RentOut::class);
    }
}

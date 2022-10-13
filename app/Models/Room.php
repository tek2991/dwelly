<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'show',
    ];

    protected $casts = [
        'show' => 'boolean',
    ];

    public static function primaryRooms()
    {
        return [
            'Hall',
            'Dining',
            'Kitchen',
            'Lobby',
            'Bedroom',
            'Bathroom',
            'Puja Room',
            'Lobby',
            'Balcony',
        ];
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class)->withPivot('quantity');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstablishmentType extends Model
{
    protected $fillable = [
        'name',
    ];

    public function nearbyEstablishments()
    {
        return $this->hasMany(NearbyEstablishment::class);
    }
}

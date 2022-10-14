<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstablishmentType extends Model
{
    protected $fillable = [
        'name',
        'icon_path',
    ];

    public function nearbyEstablishments()
    {
        return $this->hasMany(NearbyEstablishment::class);
    }
}

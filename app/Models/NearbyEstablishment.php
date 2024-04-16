<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NearbyEstablishment extends Model
{
    protected $fillable = [
        'establishment_type_id',
        'property_id',
        'description',
        'distance_in_kms',
    ];

    protected $casts = [
        'distance_in_kms' => 'float',
    ];

    public function establishmentType()
    {
        return $this->belongsTo(EstablishmentType::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}

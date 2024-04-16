<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentOut extends Model
{
    protected $fillable = [
        'contact_id',
        'property_type_id',
        'availability',
        'bedroom',
        'bathroom',
        'building_name',
        'address',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }
}

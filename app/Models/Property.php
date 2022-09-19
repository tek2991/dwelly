<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Property extends Model
{
    protected $fillable = [
        'code',
        'bhk',
        'floor_space',
        'property_type_id',
        'flooring_id',
        'furnishing_id',
        'floors',
        'total_floors',
        'address',
        'building_name',
        'landmark',
        'locality_id',
        'latitude',
        'longitude',
        'rent',
        'security_deposit',
        'society_fee',
        'booking_amount',
        'is_promoted',
        'available_from',
        'created_by',
    ];

    protected $casts = [
        'is_promoted' => 'boolean',
        'available_from' => 'date',
    ];

    protected $appends = [
        'rent',
        'security_deposit',
        'society_fee',
        'booking_amount',
    ];

    protected $hidden = [
        'rent_in_cents',
        'security_deposit_in_cents',
        'society_fee_in_cents',
        'booking_amount_in_cents',
    ];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function flooring()
    {
        return $this->belongsTo(Flooring::class);
    }

    public function furnishing()
    {
        return $this->belongsTo(Furnishing::class);
    }

    public function locality()
    {
        return $this->belongsTo(Locality::class);
    }

    public function isAvailable(){
        return $this->available_from <= now();
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class)->withPivot('quantity');
    }

    public function furnitures()
    {
        return $this->belongsToMany(Furniture::class)->withPivot('quantity', 'description');
    }

    public function establishments()
    {
        return $this->belongsToMany(Establishment::class)->withPivot('description', 'distance_in_kms');
    }

    /**
     * Interact with the rent_in_cents column.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getRentInCentsAttribute()
    {
        return new Attribute(
            get: fn ($value, $attributes) => $attributes['rent_in_cents'] / 100,

            set: fn ($value) => [
                'rent_in_cents' => $value * 100,
            ]
        );
    }

    /**
     * Interact with the security_deposit_in_cents column.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getSecurityDepositInCentsAttribute()
    {
        return new Attribute(
            get: fn ($value, $attributes) => $attributes['security_deposit_in_cents'] / 100,

            set: fn ($value) => [
                'security_deposit_in_cents' => $value * 100,
            ]
        );
    }

    /**
     * Interact with the society_fee_in_cents column.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getSocietyFeeInCentsAttribute()
    {
        return new Attribute(
            get: fn ($value, $attributes) => $attributes['society_fee_in_cents'] / 100,

            set: fn ($value) => [
                'society_fee_in_cents' => $value * 100,
            ]
        );
    }

    /**
     * Interact with the booking_amount_in_cents column.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getBookingAmountInCentsAttribute()
    {
        return new Attribute(
            get: fn ($value, $attributes) => $attributes['booking_amount_in_cents'] / 100,

            set: fn ($value) => [
                'booking_amount_in_cents' => $value * 100,
            ]
        );
    }
}

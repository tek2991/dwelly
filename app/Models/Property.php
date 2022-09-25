<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Property extends Model
{
    protected $fillable = [
        'code',
        'bhk_id',
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
        'securityDeposit',
        'societyFee',
        'bookingAmount',
        'is_promoted',
        'available_from',
        'is_available',
        'created_by',
    ];

    protected $casts = [
        'is_promoted' => 'boolean',
        'available_from' => 'date',
        'rent' => 'integer',
        'securityDeposit' => 'integer',
        'societyFee' => 'integer',
        'bookingAmount' => 'integer',
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

    public function bhk()
    {
        return $this->belongsTo(Bhk::class);
    }

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

    public function isAvailable()
    {
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

    public function checkPropertyAminity($aminity_name)
    {
        return $this->amenities->contains('name', $aminity_name);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class)->withPivot('quantity');
    }

    public function getNoOfRooms($room_name)
    {
        $room = $this->rooms()->where('name', $room_name)->first();
        return $room ? $room->pivot->quantity : 0;
    }

    public function furnitures()
    {
        return $this->belongsToMany(Furniture::class)->withPivot('quantity', 'description');
    }

    public function nearbyEstablishments()
    {
        return $this->hasMany(NearbyEstablishment::class);
    }

    public function propertyImages()
    {
        return $this->hasMany(PropertyImage::class);
    }

    /**
     * Interact with the rent_in_cents column.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function rent(): Attribute
    {
        return Attribute::make(
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
    protected function securityDeposit(): Attribute
    {
        return Attribute::make(
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
    protected function societyFee(): Attribute
    {
        return Attribute::make(
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
    protected function bookingAmount(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['booking_amount_in_cents'] / 100,

            set: fn ($value) => [
                'booking_amount_in_cents' => $value * 100,
            ]
        );
    }
}

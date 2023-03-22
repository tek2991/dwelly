<?php

namespace App\Models;

use App\Models\Audit;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Property extends Model
{
    use Searchable;
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
        return $this->available_from <= now() && $this->is_available;
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

    public function getNoOfFurnitures($furniture_name)
    {
        $furniture = $this->furnitures()->where('name', $furniture_name)->first();
        return $furniture ? $furniture->pivot->quantity : 0;
    }

    public function getFurnitureIcon($furniture_name)
    {
        $furniture = Furniture::where('name', $furniture_name)->first();
        return $furniture ? $furniture->icon_path : '';
    }

    public function nearbyEstablishments()
    {
        return $this->hasMany(NearbyEstablishment::class);
    }

    public function propertyImages()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function coverImage()
    {
        return $this->hasOne(PropertyImage::class)->where('is_cover', true);
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

    public function tenants()
    {
        return $this->belongsToMany(User::class, 'tenants', 'property_id', 'user_id');
    }

    // Private function to get owners of the property
    private function owners()
    {
        return $this->belongsToMany(User::class, 'owners', 'property_id', 'user_id');
    }

    public function owner()
    {
        $owners = $this->owners()->get();
        return $owners->first();
    }

    public function audits()
    {
        return $this->hasMany(Audit::class);
    }

    public function hasPropertyOnboardingAudit()
    {
        $propertyOnboardingTypeId = AuditType::where('name', 'Property Onboarding')->first()->id;
        return $this->audits()->where('audit_type_id', $propertyOnboardingTypeId)->exists();
    }

    public function onboarding()
    {
        return $this->hasOne(Onboarding::class);
    }

    /**
     * Set ammenities attributes indexable by Scout.
     *
     * @return array
     */
    public function ammenitiesAttributes(): array
    {
        return [
            'Lift', 'Parking', 'Power Backup', 'Security', 'Swimming Pool', "Pets Friendly", "Bachelor Friendly", "Student Friendly", "Couples Friendly", "Family Friendly"
        ];
    }


    /**
     * Determine if the model should be searchable.
     *
     * @return bool
     */
    public function shouldBeSearchable()
    {
        return $this->isAvailable();
    }


    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        // Return only the fields you want to index
        $property = [
            'code' => $this->code,
            'address' => $this->address,
            'building_name' => $this->building_name,
            'landmark' => $this->landmark,

            'rent' => $this->rent,

            'bhk' => $this->bhk->name,
            'bhk_id' => $this->bhk->id,

            'property_type' => $this->propertyType->name,
            'property_type_id' => $this->propertyType->id,

            'flooring' => $this->flooring->name,
            'flooring_id' => $this->flooring->id,

            'furnishing' => $this->furnishing->name,
            'furnishing_id' => $this->furnishing->id,

            'locality' => $this->locality->name,
            'locality_id' => $this->locality->id,

            // Add the names separated by comma of the amenities, rooms and furnitures
            'amenities' => $this->amenities->pluck('name',)->implode(','),
            'rooms' => $this->rooms->pluck('name')->implode(','),
            'furnitures' => $this->furnitures->pluck('name')->implode(','),
        ];

        // Add the names separated by comma of the amenities attributes
        foreach ($this->ammenitiesAttributes() as $attribute) {
            $property[$attribute] = $this->checkPropertyAminity($attribute);
        }

        return $property;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Furniture extends Model
{
    protected $table = 'furnitures';
    protected $fillable = [
        'name',
        'icon_path',
        'show',

        'is_primary',
        'primary_furniture_id',
    ];

    protected $casts = [
        'show' => 'boolean',
    ];

    public function properties()
    {
        return $this->belongsToMany(Property::class)->withPivot('quantity', 'description');
    }

    public function auditChecklists()
    {
        return $this->morphMany(AuditChecklist::class, 'checklistable');
    }

    public function primaryFurniture()
    {
        return $this->belongsTo(Furniture::class, 'primary_furniture_id');
    }

    public function secondaryFurnitures()
    {
        return $this->hasMany(Furniture::class, 'primary_furniture_id');
    }
}

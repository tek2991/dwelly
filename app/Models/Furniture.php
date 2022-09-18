<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Furniture extends Model
{
    protected $fillable = [
        'name',
        'icon_path',
        'show',
    ];
}

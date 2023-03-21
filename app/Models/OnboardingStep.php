<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnboardingStep extends Model
{
    protected $fillable = [
        'name',
    ];

    public function onboardings()
    {
        return $this->hasMany(Onboarding::class);
    }
}

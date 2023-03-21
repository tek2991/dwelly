<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Onboarding extends Model
{
    protected $fillable = [
        'property_id',
        'onboarding_step_id',
        'completed',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function onboardingStep()
    {
        return $this->belongsTo(OnboardingStep::class);
    }
}

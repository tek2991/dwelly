<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = [
        'user_id',
        'property_id',
        'onboarded_at',
        'outboarded_at',

        'beneficiary_name',
        'bank_name',
        'ifsc',
        'account_number',

        'electricity_consumer_id_old',
        'electricity_consumer_id_new',
    ];

    protected $dates = [
        'onboarded_at',
        'outboarded_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable')->with('documentType');
    }

    public function bankDetails()
    {
        return $this->morphMany(BankDetail::class, 'bankable')->with('document');
    }
}

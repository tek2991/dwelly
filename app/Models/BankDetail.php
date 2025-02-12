<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    protected $fillable = [
        'beneficiary_name',
        'bank_name',
        'ifsc',
        'account_number',
        'is_current',
        'bankable_type',
        'bankable_id',
    ];

    public function bankable()
    {
        return $this->morphTo();
    }

    public function document()
    {
        return $this->morphOne(Document::class, 'documentable')->with('documentType');
    }
}

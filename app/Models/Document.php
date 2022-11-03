<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'document_type_id',
        'file_path',
    ];

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function documentable()
    {
        return $this->morphTo();
    }
}


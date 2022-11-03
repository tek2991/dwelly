<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'document_type_id',
        'file_path',
    ];
    public function owners()
    {
        return $this->morphedByMany(Owner::class, 'documentable');
    }

    public function tenants()
    {
        return $this->morphedByMany(Tenant::class, 'documentable');
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }
}


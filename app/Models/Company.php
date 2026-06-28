<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id',
    'company_name',
    'vat_number',
    'tax_code',
    'pec',
    'sdi_code',
    'legal_address',
    'website'
])]

class Company extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

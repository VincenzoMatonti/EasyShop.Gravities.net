<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'vat_number',
        'tax_code',
        'pec',
        'sdi_code',
        'legal_address',
        'website'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

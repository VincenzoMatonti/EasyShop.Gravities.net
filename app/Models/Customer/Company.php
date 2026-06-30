<?php

namespace App\Models\Customer;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

class Company extends Model
{
    protected $fillable = [
        'company_name',
        'vat_number',
        'tax_code',
        'pec',
        'sdi_code',
        'legal_address',
        'website'
    ];

    public function customerProfiles()
    {
        return $this->hasMany(CustomerProfile::class);
    }
}

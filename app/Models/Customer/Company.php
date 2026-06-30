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

    public function emails()
    {
        return $this->morphMany(Email::class, 'emailable');
    }

    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}

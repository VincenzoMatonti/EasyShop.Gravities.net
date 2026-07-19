<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_name',
        'vat_number',
        'tax_code',
        'pec',
        'sdi_code',
        'website',
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

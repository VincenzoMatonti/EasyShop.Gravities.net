<?php

namespace App\Models\Customer;

use App\Enum\CustomerProfileType;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CustomerProfile extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'type',
        'is_deleted',
    ];

    protected function casts(): array
    {
        return [
            'type' => CustomerProfileType::class,
            'is_default' => 'boolean',
            'is_deleted' => 'boolean',
        ];
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->using(UserCustomerProfile::class)
                    ->withPivot(['role', 'is_default'])
                    ->withTimestamps();
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function segments()
    {
        return $this->belongsToMany(Segment::class);
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

    public function isBusiness(): bool
    {
        return $this->type === CustomerProfileType::business;
    }

    public function isPersonal(): bool
    {
        return $this->type === CustomerProfileType::personal;
    }

    public function scopeDeleted(Builder $query): Builder
    {
        return $query->where('is_deleted', true);
    }

    public function scopeDefault(Builder $query): Builder
    {
        return $query->where('is_default', true);
    }

    public function scopeBusiness(Builder $query): Builder
    {
        return $query->where('type', CustomerProfileType::business);
    }

    public function scopePersonal(Builder $query): Builder
    {
        return $query->where('type', CustomerProfileType::personal);
    }
}

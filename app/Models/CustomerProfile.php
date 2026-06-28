<?php

namespace App\Models;

use App\CustomerProfileType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CustomerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'name',
        'type',
        'is_default',
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

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_deleted', false);
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function isBusiness(): bool
    {
        return $this->type === CustomerProfileType::business;
    }

    public function isPersonal(): bool
    {
        return $this->type === CustomerProfileType::personal;
    }
}

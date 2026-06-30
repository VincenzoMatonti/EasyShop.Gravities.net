<?php

namespace App\Models\Customer;

use App\LabelAddress;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;


class Address extends Model
{
    protected $fillable = [
        'is_deleted',
        'label',
        'street',
        'number',
        'zip_code',
        'city',
        'province',
        'country',
        'is_shipping',
        'is_billing',
        'is_default',
    ];

    protected function casts(): array
    {
        return [
            'label' => LabelAddress::class,
            'is_deleted' => 'boolean',
            'is_shipping' => 'boolean',
            'is_billing' => 'boolean',
            'is_default' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_deleted', false);
    }

    public function emailable()
    {
        return $this->morphTo();
    }
}

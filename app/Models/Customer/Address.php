<?php

namespace App\Models\Customer;

use App\Enum\Customer\LabelAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Address extends Model
{
    protected $fillable = [
        'label',
        'street',
        'number',
        'zip_code',
        'city',
        'province',
        'country',
        'is_default',
        'is_deleted',
    ];

    protected function casts(): array
    {
        return [
            'label' => LabelAddress::class,
            'is_default' => 'boolean',
            'is_deleted' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_deleted', false);
    }

    public function addressable()
    {
        return $this->morphTo();
    }
}

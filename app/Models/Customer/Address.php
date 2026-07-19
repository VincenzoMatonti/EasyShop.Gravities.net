<?php

namespace App\Models\Customer;

use App\Enum\Customer\LabelAddress;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property LabelAddress $label
 * @property string $street
 * @property string $number
 * @property string $zip_code
 * @property string $city
 * @property string|null $province
 * @property string $country
 * @property bool $is_default
 * @property bool $is_deleted
 */
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

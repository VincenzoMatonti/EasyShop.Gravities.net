<?php

namespace App\Models;

use App\LabelAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id',
    'label',
    'street',
    'number',
    'zip_code',
    'city',
    'province',
    'country',
    'is_shipping',
    'is_billing',
    'is_default'
])]


class Address extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'label' => LabelAddress::class,
        ];
    }
}

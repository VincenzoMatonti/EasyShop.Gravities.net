<?php

namespace App\Models;

use App\Gender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id',
    'name',
    'surname',
    'tax_code',
    'phone',
    'birth_date',
    'birth_place',
    'nationality',
    'gender',
    'residence',
    'domicile'
])]

class UserInfo extends Model
{
    protected function casts(): array
    {
        return [
            'gender' => Gender::class,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

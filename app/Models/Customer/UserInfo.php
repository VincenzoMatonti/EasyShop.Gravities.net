<?php

namespace App\Models\Customer;

use App\Enum\Gender;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id',
    'name',
    'surname',
    'tax_code',
    'birth_date',
    'birth_place',
    'nationality',
    'gender',
    'residence',
    'domicile'
])]

class UserInfo extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'tax_code',
        'birth_date',
        'birth_place',
        'nationality',
        'gender',
        'residence',
        'domicile'
    ];
    
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

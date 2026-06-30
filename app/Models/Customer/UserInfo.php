<?php

namespace App\Models\Customer;

use App\Enum\Customer\Gender;
use App\Models\Identity\User;
use Illuminate\Database\Eloquent\Model;

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

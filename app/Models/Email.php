<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id',
    'email',
    'is_primary',
    'is_deleted',
    'verified_at',
])]

class Email extends Model
{
    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
            'is_deleted' => 'boolean',
            'verified_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

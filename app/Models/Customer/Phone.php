<?php

namespace App\Models\Customer;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;

#[Fillable([
    'user_id',
    'phone',
    'is_primary',
    'is_verified',
    'is_deleted',
])]

class Phone extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'is_primary',
        'is_verified',
        'is_deleted',
    ];

    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
            'is_verified' => 'boolean',
            'is_deleted' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_deleted', false);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

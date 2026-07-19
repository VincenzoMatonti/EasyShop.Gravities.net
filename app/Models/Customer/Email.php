<?php

namespace App\Models\Customer;

use App\Enum\Customer\LabelEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        'label',
        'email',
        'is_primary',
        'is_deleted',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'label' => LabelEmail::class,
            'is_primary' => 'boolean',
            'is_deleted' => 'boolean',
            'verified_at' => 'datetime',
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

<?php

namespace App\Models\Customer;

use App\Enum\Customer\LabelPhone;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = [
        'label',
        'prefix',
        'number',
        'is_primary',
        'is_verified',
        'is_deleted',
    ];

    protected function casts(): array
    {
        return [
            'label' => LabelPhone::class,
            'is_primary' => 'boolean',
            'is_verified' => 'boolean',
            'is_deleted' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_deleted', false);
    }

    public function phoneable()
    {
        return $this->morphTo();
    }
}

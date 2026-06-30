<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MacroCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'is_deleted',
    ];

    protected function casts(): array
    {
        return [
            'is_deleted' => 'boolean',
        ];
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_deleted', false);
    }
}

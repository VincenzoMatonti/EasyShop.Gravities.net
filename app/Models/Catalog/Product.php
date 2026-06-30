<?php

namespace App\Models\Catalog;

use App\Enum\Catalog\ProductStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'description',
        'status',
        'is_deleted',
    ];

    protected function casts(): array
    {
        return [
            'status' => ProductStatus::class,
            'is_deleted' => 'boolean',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function segments()
    {
        return $this->belongsToMany(ProductSegment::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_deleted', false);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 1);
    }
}

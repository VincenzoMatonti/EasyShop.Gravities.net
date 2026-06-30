<?php

namespace App\Models\Catalog;

use App\Enum\Catalog\MediaType;
use Illuminate\Database\Eloquent\Model;

class ProductMedia extends Model
{
    protected $fillable = [
        'product_variant_id',
        'type',
        'url',
        'position',
    ];

    protected function casts(): array
    {
        return [
           'type' => MediaType::class,
        ];
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
}

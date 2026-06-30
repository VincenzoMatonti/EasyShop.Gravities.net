<?php

namespace App\Models\Catalog;

use App\Enum\Catalog\Currency;
use App\Models\Inventory\InventoryItem;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'sku',
        'name',
        'price',
        'currency',
        'compare_price',
        'attributes',
        'is_default',
        'is_deleted',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'compare_price' => 'decimal:2',
            'currency' => Currency::class,
            'attributes' => 'array',
        ];
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function media()
    {
        return $this->hasMany(ProductMedia::class);
    }

    public function inventoryItem()
    {
        return $this->hasOne(InventoryItem::class);
    }
}

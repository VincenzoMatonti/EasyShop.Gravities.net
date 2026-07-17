<?php

namespace App\Models\Inventory;

use App\Models\Catalog\ProductVariant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

class InventoryItem extends Model
{
    protected $fillable = [
        'product_variant_id',
        'quantity',
        'reserved_quantity',
        'sold_quantity',
        'low_stock_threshold',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'reserved_quantity' => 'integer',
        'sold_quantity' => 'integer',
        'low_stock_threshold' => 'integer',
    ];

    /* -----------------------------------
     | RELATION
     ----------------------------------- */
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    /* -----------------------------------
     | SCOPES
     ----------------------------------- */

    public function scopeInStock(Builder $query): Builder
    {
        return $query->whereColumn('quantity', '>', 'reserved_quantity');
    }

    public function scopeOutOfStock(Builder $query): Builder
    {
        return $query->whereColumn('quantity', '<=', 'reserved_quantity');
    }

    public function scopeLowStock(Builder $query): Builder
    {
        return $query->whereRaw('(quantity - reserved_quantity) <= low_stock_threshold');
    }

    /* -----------------------------------
     | DOMAIN LOGIC
     ----------------------------------- */

    public function available(): int
    {
        return max(0, $this->quantity - $this->reserved_quantity);
    }

    public function isInStock(): bool
    {
        return $this->available() > 0;
    }

    public function isLowStock(): bool
    {
        return $this->available() <= $this->low_stock_threshold;
    }

    public function canReserve(int $qty): bool
    {
        return $qty > 0 && $this->available() >= $qty;
    }

    public function reserve(int $qty): void
    {
        if (! $this->canReserve($qty)) {
            throw new RuntimeException('Insufficient stock to reserve.');
        }

        $this->increment('reserved_quantity', $qty);
    }

    public function release(int $qty): void
    {
        $this->decrement('reserved_quantity', $qty);
    }

    public function decreaseStock(int $qty): void
    {
        if ($qty <= 0) {
            return;
        }

        $this->decrement('quantity', $qty);
    }

    public function commitSale(int $qty): void
    {
        if (! $this->canReserve($qty)) {
            throw new RuntimeException('Cannot commit sale: insufficient reserved stock.');
        }

        $this->decrement('reserved_quantity', $qty);
        $this->decrement('quantity', $qty);
        $this->increment('sold_quantity', $qty);
    }
}

<?php

namespace App\Models\Cart;

use App\Models\Catalog\ProductVariant;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'product_variant_id',
        'quantity',
        'product_name_snapshot',
        'variant_name_snapshot',
        'sku_snapshot',
        'currency_snapshot',
        'unit_price_snapshot',
        'discount_snapshot',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'unit_price_snapshot' => 'decimal:2',
            'discount_snapshot' => 'decimal:2',
        ];
    }
	/*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
	
	/*
    |--------------------------------------------------------------------------
    | SNAPSHOT GETTERS 
    |--------------------------------------------------------------------------
    */

    public function getProductName(): string
    {
        return $this->product_name_snapshot;
    }

    public function getVariantName(): ?string
    {
        return $this->variant_name_snapshot;
    }

    public function getSku(): ?string
    {
        return $this->sku_snapshot;
    }

    public function getCurrency(): string
    {
        return $this->currency_snapshot;
    }

    /*
    |--------------------------------------------------------------------------
    | PRICE DOMAIN LOGIC
    |--------------------------------------------------------------------------
    */

    public function unitPrice(): float
    {
        return (float) $this->unit_price_snapshot;
    }

    public function discount(): float
    {
        return (float) $this->discount_snapshot;
    }

    public function effectiveUnitPrice(): float
    {
        return max(0, $this->unitPrice() - $this->discount());
    }

    /*
    |--------------------------------------------------------------------------
    | QUANTITY DOMAIN LOGIC
    |--------------------------------------------------------------------------
    */

    public function subtotal(): float
    {
        return $this->quantity * $this->effectiveUnitPrice();
    }

    public function incrementQuantity(int $qty = 1): void
    {
        $this->increment('quantity', $qty);
    }

    public function decrementQuantity(int $qty = 1): void
    {
        $newQty = max(1, $this->quantity - $qty);

        $this->update(['quantity' => $newQty]);
    }

    public function setQuantity(int $qty): void
    {
        $this->update(['quantity' => max(1, $qty)]);
    }

    /*
    |--------------------------------------------------------------------------
    | DOMAIN RULES
    |--------------------------------------------------------------------------
    */

    public function isFree(): bool
    {
        return $this->effectiveUnitPrice() <= 0;
    }

    public function hasDiscount(): bool
    {
        return $this->discount() > 0;
    }

    public function isBulk(): bool
    {
        return $this->quantity >= 10;
    }
	
	public function isEmpty(): bool
    {
        return $this->quantity <= 0;
    }
	
	/*
    |--------------------------------------------------------------------------
    | CALCULATED HELPERS
    |--------------------------------------------------------------------------
    */

    public function totalBeforeDiscount(): float
    {
        return $this->quantity * $this->unitPrice();
    }

    public function totalDiscount(): float
    {
        return $this->quantity * $this->discount();
    }

    public function total(): float
    {
        return $this->subtotal();
    }
}

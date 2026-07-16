<?php

namespace App\Models\Order;

use App\Models\Catalog\ProductVariant;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_variant_id',
        'quantity',
        'unit_price',
        'total_price',
        'product_name_snapshot',
        'sku_snapshot',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'unit_price' => 'decimal:2',
            'total_price' => 'decimal:2',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    /*
    |--------------------------------------------------------------------------
    | PRICE LOGIC
    |--------------------------------------------------------------------------
    */

    public function unitPrice(): float
    {
        return (float) $this->unit_price;
    }

    public function quantity(): int
    {
        return (int) $this->quantity;
    }

    public function total(): float
    {
        return (float) $this->total_price;
    }
	
	public function calculateTotal(): float
	{
		return $this->quantity() * $this->unitPrice();
	}

    /*
    |--------------------------------------------------------------------------
    | VALIDATION LOGIC
    |--------------------------------------------------------------------------
    */
	
	protected static function booted(): void
	{
		static::saving(function ($item) {
			$item->total_price = $item->calculateTotal();
		});
	}
	
    public function isFree(): bool
    {
        return $this->unitPrice() <= 0;
    }

    public function hasMismatch(): bool
    {
        return abs($this->calculateTotal() - $this->total()) > 0.01;
    }
}

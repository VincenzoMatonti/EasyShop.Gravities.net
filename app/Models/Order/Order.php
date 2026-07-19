<?php

namespace App\Models\Order;

use App\Enum\Catalog\Currency;
use App\Enum\Order\OrderStatus;
use App\Models\Customer\CustomerProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property OrderStatus $status
 * @property Currency $currency
 */
class Order extends Model
{
    protected $fillable = [
        'customer_profile_id',
        'status',
        'subtotal',
        'tax_total',
        'shipping_total',
        'discount_total',
        'grand_total',
        'currency',
        'shipping_address_snapshot',
        'billing_address_snapshot',
    ];

    protected function casts(): array
    {
        return [
            'status' => OrderStatus::class,
            'subtotal' => 'decimal:2',
            'tax_total' => 'decimal:2',
            'shipping_total' => 'decimal:2',
            'discount_total' => 'decimal:2',
            'grand_total' => 'decimal:2',
            'currency' => Currency::class,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function customerProfile(): BelongsTo
    {
        return $this->belongsTo(CustomerProfile::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /*
    |--------------------------------------------------------------------------
    | STATUS
    |--------------------------------------------------------------------------
    */

    public function isPending(): bool
    {
        return $this->status === OrderStatus::pending;
    }

    public function isPaid(): bool
    {
        return $this->status === OrderStatus::paid;
    }

    public function isShipped(): bool
    {
        return $this->status === OrderStatus::shipped;
    }

    public function isDelivered(): bool
    {
        return $this->status === OrderStatus::delivered;
    }

    public function isCancelled(): bool
    {
        return $this->status === OrderStatus::cancelled;
    }

    /*
    |--------------------------------------------------------------------------
    | BUSINESS ACTIONS
    |--------------------------------------------------------------------------
    */

    public function markAsPaid(): void
    {
        $this->status = OrderStatus::paid;
        $this->save();
    }

    public function markAsShipped(): void
    {
        $this->status = OrderStatus::shipped;
        $this->save();
    }

    public function cancelOrder(): void
    {
        $this->status = OrderStatus::cancelled;
        $this->save();
    }

    /*
    |--------------------------------------------------------------------------
    | TOTALS
    |--------------------------------------------------------------------------
    */

    public function itemsCount(): int
    {
        return $this->items()->sum('quantity');
    }

    public function getSubtotal(): float
    {
        return (float) $this->subtotal;
    }

    public function getGrandTotal(): float
    {
        return (float) $this->grand_total;
    }

    public function getProfit(): float
    {
        return $this->subtotal - $this->discount_total;
    }
}

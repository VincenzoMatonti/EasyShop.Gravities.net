<?php

namespace App\Models\Cart;

use App\Enum\Cart\CartStatus;
use App\Models\Customer\CustomerProfile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read Collection<int, CartItem> $items
 */
class Cart extends Model
{
    protected $fillable = [
        'customer_profile_id',
        'status',
        'converted_at',
        'abandoned_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => CartStatus::class,
            'converted_at' => 'datetime',
            'abandoned_at' => 'datetime',
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
        return $this->hasMany(CartItem::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', CartStatus::active);
    }

    public function scopeConverted(Builder $query): Builder
    {
        return $query->where('status', CartStatus::converted);
    }

    public function scopeAbandoned(Builder $query): Builder
    {
        return $query->where('status', CartStatus::abandoned);
    }

    /*
    |--------------------------------------------------------------------------
    | STATE CHECKS
    |--------------------------------------------------------------------------
    */

    public function isActive(): bool
    {
        return $this->status === CartStatus::active;
    }

    public function isConverted(): bool
    {
        return $this->status === CartStatus::converted;
    }

    public function isAbandoned(): bool
    {
        return $this->status === CartStatus::abandoned;
    }

    /*
    |--------------------------------------------------------------------------
    | DOMAIN ACTIONS (LIGHT)
    |--------------------------------------------------------------------------
    */

    public function markAsConverted(): void
    {
        $this->update([
            'status' => CartStatus::converted,
            'converted_at' => now(),
        ]);
    }

    public function markAsAbandoned(): void
    {
        $this->update([
            'status' => CartStatus::abandoned,
            'abandoned_at' => now(),
        ]);
    }

    public function reopen(): void
    {
        $this->update([
            'status' => CartStatus::active,
            'abandoned_at' => null,
            'converted_at' => null,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | ITEMS DOMAIN HELPERS
    |--------------------------------------------------------------------------
    */

    public function itemCount(): int
    {
        return $this->items()->sum('quantity');
    }

    public function itemsCountDistinct(): int
    {
        return $this->items()->count();
    }

    public function isEmpty(): bool
    {
        return $this->items()->count() === 0;
    }

    /*
    |--------------------------------------------------------------------------
    | PRICING AGGREGATION (IMPORTANT)
    |--------------------------------------------------------------------------
    */

    public function subtotal(): float
    {
        return $this->items->sum(fn ($item) => $item->subtotal());
    }

    public function totalDiscount(): float
    {
        return $this->items->sum(fn ($item) => $item->totalDiscount());
    }

    public function totalBeforeDiscount(): float
    {
        return $this->items->sum(fn ($item) => $item->totalBeforeDiscount());
    }

    public function total(): float
    {
        return $this->subtotal();
    }

    /*
    |--------------------------------------------------------------------------
    | CART OPERATIONS (LIGHT DOMAIN LAYER)
    |--------------------------------------------------------------------------
    */

    public function clear(): void
    {
        $this->items()->delete();
    }
}

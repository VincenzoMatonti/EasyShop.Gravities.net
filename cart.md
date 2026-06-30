# Cart Domain

## Purpose
Gestisce carrelli attivi degli utenti.

---

## Entities
- Cart
- CartItem

---

## Relations
- CustomerProfile 1-1 Cart
- Cart 1-N CartItem
- CartItem N-1 ProductVariant

---

## Core Concept
Il carrello è temporaneo fino alla conversione in ordine.

---

## Common Usage

### Get active cart
$profile->cart

### Get cart items
$cart->items

### Get product variants in cart
$cart->items->map(fn($i) => $i->productVariant)
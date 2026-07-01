# Order Domain

## Purpose
Gestisce ordini e storico acquisti.

---

## Entities
- Order
- OrderItem

---

## Relations
- CustomerProfile 1-N Order
- Order 1-N OrderItem
- OrderItem N-1 ProductVariant

---

## Core Concept
Order è la fonte di verità del sistema.

---

## Common Usage

### Get user orders
$profile->orders

### Get order items
$order->items

### Get purchased products
$order->items->map(fn($i) => $i->productVariant)
# Inventory Domain

## Purpose
Gestisce disponibilità dei prodotti.

---

## Entities
- InventoryItem

---

## Relations
- InventoryItem N-1 ProductVariant

---

## Core Concept
Inventory è legato alle varianti prodotto.

---

## Common Usage

### Get stock for variant
$variant->inventoryItem->quantity

### Check availability
$variant->inventoryItem->quantity > 0
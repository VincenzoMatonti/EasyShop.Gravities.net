# 📦 Inventory Domain - Usage Guide

Questo file descrive tutti i metodi disponibili in `InventoryItem` e come utilizzarli correttamente.

---

# 📍 1. RELATION

## productVariant()

```php
$inventory->productVariant;

✔ Ritorna la variante prodotto collegata allo stock.

📍 2. SCOPES
scopeInStock()
InventoryItem::inStock()->get();

✔ Ritorna solo prodotti con stock disponibile.

scopeOutOfStock()
InventoryItem::outOfStock()->get();

✔ Ritorna prodotti esauriti.

scopeLowStock()
InventoryItem::lowStock()->get();

✔ Ritorna prodotti sotto soglia minima.

📍 3. STOCK CALCULATION
available()
$inventory->available();

✔ Calcola stock disponibile reale.

Formula:

quantity - reserved_quantity
isInStock()
$inventory->isInStock();

✔ True se almeno 1 unità disponibile.

isLowStock()
$inventory->isLowStock();

✔ True se stock sotto soglia.

canReserve()
$inventory->canReserve(3);

✔ Verifica se è possibile riservare quantità.

📍 4. STOCK OPERATIONS
reserve()
$inventory->reserve(2);

✔ Riserva stock per un ordine.

⚠ Lancia eccezione se non disponibile.

release()
$inventory->release(2);

✔ Rilascia stock precedentemente riservato.

decreaseStock()
$inventory->decreaseStock(2);

✔ Riduce quantità totale stock.

⚠ Usare solo in casi controllati (admin/import)

commitSale()
$inventory->commitSale(2);

✔ Finalizza vendita:

decrementa quantity
decrementa reserved_quantity
incrementa sold_quantity
📍 5. FLOW CONSIGLIATO (IMPORTANTISSIMO)
Checkout flow corretto:
1. Reserve stock
$inventory->reserve($qty);
2. Payment success
$inventory->commitSale($qty);
3. Payment failed / cancel
$inventory->release($qty);
# 📦 Inventory Domain

## Overview

L’Inventory Domain gestisce la disponibilità fisica dei prodotti vendibili nel sistema.

È collegato direttamente al Catalog Domain tramite `ProductVariant`, che rappresenta la singola variante acquistabile di un prodotto.

---

## Entity principale

### InventoryItem

Rappresenta lo stock reale e gestito di una specifica `ProductVariant`.

Ogni InventoryItem contiene:

- quantità totale disponibile (`quantity`)
- quantità riservata (`reserved_quantity`)
- quantità venduta (`sold_quantity`)
- soglia minima per alert (`low_stock_threshold`)

---

## Relazioni

- InventoryItem → belongsTo → ProductVariant

---

## Concetti di dominio

### 1. Stock disponibile
Lo stock reale disponibile per vendite è: available = quantity - reserved_quantity


---

### 2. Reserved stock
Quantità bloccata per ordini non ancora completati.

---

### 3. Sold stock
Quantità già venduta e finalizzata.

---

### 4. Low stock
Un item è considerato “low stock” quando: available <= low_stock_threshold


---

## Responsabilità del dominio

Questo dominio è responsabile di:

- gestione stock
- prenotazione quantità
- rilascio stock
- finalizzazione vendita
- controllo disponibilità

---

## NON responsabilità

Non gestisce:

- ordini
- pagamenti
- carrello
- logica cliente

---

## Nota architetturale

La logica è contenuta nel Model, ma può essere orchestrata tramite:

- Actions 
- Jobs asincroni 

---

## Evoluzione futura

- integrazione con queue system (Redis)
- event-driven stock management
- multi-warehouse support (future extension)
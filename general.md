# E-commerce Models Architecture

## Purpose
Sistema e-commerce B2C + B2B basato su domini separati.

---

## Core Entities

- User → identità tecnica
- CustomerProfile → soggetto operativo
- Company → entità B2B
- ProductVariant → unità vendibile
- Order → verità commerciale

---

## Domains

- Identity → auth e ruoli
- Customer → utenti e aziende
- Catalog → prodotti
- Inventory → stock
- Cart → acquisti temporanei
- Order → acquisti finali
- Company → struttura B2B

---

## Core Flow

User → CustomerProfile → Cart → Order → Inventory

---

## Design Principles

### 1. CustomerProfile-centric
Tutte le operazioni commerciali passano da CustomerProfile.

---

### 2. Snapshot Strategy
Order salva dati storici (prezzi, indirizzi, prodotti).

---

### 3. Polymorphic Contacts
Address / Phone / Email condivisi tra entità diverse.

---

## Common Usage (Global)

### Get user full context
$user->customerProfiles->first()

### Get company context
$profile->company

### Get orders
$profile->orders

### Get catalog browsing
Product::with('variants.media')->get()
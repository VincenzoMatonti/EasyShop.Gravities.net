# 📦 Catalog Domain

Il Catalog Domain gestisce tutta la struttura dei prodotti all’interno dell’ecommerce.

È composto da entità gerarchiche e relazionali che descrivono:
- organizzazione merceologica
- brand e segmentazione commerciale
- varianti di prodotto
- media associati

---

## 🧠 Concetti principali

### 🏷️ Product
Rappresenta il prodotto principale.

Un Product:
- appartiene a una Category
- appartiene a un Brand
- può avere più Variants
- può appartenere a più Segments

---

### 📦 ProductVariant
Rappresenta la variante vendibile del prodotto.

Esempi:
- taglia
- colore
- versione

Ogni variant contiene:
- SKU
- prezzo
- currency
- attributi JSON
- media

---

### 🖼️ ProductMedia
Media collegati alla variante:
- immagini
- video

Ordinate tramite `position`.

---

### 🏷️ Category
Struttura merceologica base.

Esempio:
- Abbigliamento
- Elettronica
- Casa

Relazione:
- Category 1 → N Products

---

### 🏢 Brand
Rappresenta il produttore o marchio del prodotto.

Relazione:
- Brand 1 → N Products

---

### 🎯 Segment
Rappresenta la segmentazione commerciale/marketing.

Esempi:
- Premium
- Kids
- Business
- Outlet

Relazione:
- Segment N ↔ N Products

---

## 🔗 Relazioni complete

Product:
- belongsTo Category
- belongsTo Brand
- hasMany ProductVariant
- belongsToMany Segment

ProductVariant:
- belongsTo Product
- hasMany ProductMedia

---

## ⚙️ Scelte architetturali

- Soft delete gestito con `is_deleted`
- Enum per status prodotto (INT castato via enum PHP)
- Currency gestita come enum string (ISO 4217)
- Segment usato per marketing segmentation (non categoria)

---

## 📌 Obiettivo del dominio

Separare:
- struttura merceologica (Category)
- struttura commerciale (Segment)
- struttura brand (Brand)
- struttura vendibile (Variant)
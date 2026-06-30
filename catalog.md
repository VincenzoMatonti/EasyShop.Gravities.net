# Catalog Domain

## Purpose
Gestisce prodotti e struttura del catalogo vendibile.

---

## Entities
- Category
- Brand
- Segment
- Product
- ProductVariant
- ProductMedia

---

## Relations
- Category 1-N Product
- Brand 1-N Product
- Product 1-N ProductVariant
- ProductVariant 1-N ProductMedia
- Segment N-N Product (product_segment pivot)

---

## Core Concept
ProductVariant è l’unità vendibile reale.

---

## Common Usage

### Get product variants
$product->variants

### Get media
$variant->media

### Get category products
$category->products
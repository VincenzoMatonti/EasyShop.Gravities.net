# ⚙️ Catalog Domain - USAGE GUIDE

Questo file contiene tutti i comandi e pattern di utilizzo del Catalog Domain.

---

# 📁 CATEGORY

## Creazione Category
```php
Category::create([
    'macro_category_id' => 1,
    'name' => 'Shoes',
    'slug' => 'shoes'
]);

## Query base
Category::active()->get();
Category::with(['products'])->get();
Relazioni
$category->products;
$category->macroCategory;

# 🏷️ BRAND
#  Creazione Brand
Brand::create([
    'name' => 'Nike',
    'slug' => 'nike'
]);

#Query

Brand::with(['products'])->get();
Relazioni
$brand->products;

#🏢 MACRO CATEGORY
## Creazione MacroCategory
MacroCategory::create([
    'name' => 'Fashion',
    'slug' => 'fashion'
]);

# Query
MacroCategory::with('categories')->get();

## Relazioni
$macroCategory->categories;

# 📦 PRODUCT
## Creazione Product
Product::create([
    'brand_id' => 1,
    'category_id' => 2,
    'name' => 'Air Force 1',
    'slug' => 'air-force-1',
    'description' => 'Classic sneaker',
    'status' => ProductStatus::published
]);

# Query completa (catalogo)
Product::with([
    'brand',
    'category',
    'variants.media',
    'segments'
])->get();

# Query pubblicati
Product::where('status', ProductStatus::published)->get();
Relazioni
$product->brand;
$product->category;
$product->variants;
$product->segments;


# 🧩 PRODUCT VARIANT
## Creazione Variant
ProductVariant::create([
    'product_id' => 1,
    'sku' => 'AF1-WHITE-42',
    'name' => 'White 42',
    'price' => 12000,
    'currency' => Currency::EUR,
    'compare_price' => 15000,
    'attributes' => [
        'size' => 42,
        'color' => 'white'
    ]
]);
# Query

ProductVariant::with(['media', 'product'])->get();

# Relazioni
$variant->product;
$variant->media;


# 🖼️ PRODUCT MEDIA
## Creazione Media
ProductMedia::create([
    'product_variant_id' => 1,
    'type' => 'image',
    'url' => '/storage/products/af1.jpg',
    'position' => 1
]);

## Query
ProductMedia::where('product_variant_id', $id)->get();


# 🎯 SEGMENTS

## Creazione Segment
Segment::create([
    'name' => 'Sport'
]);

## Attach Product
$product->segments()->attach($segmentId);

## Sync Segments
$product->segments()->sync([1, 2, 3]);

## Query
Segment::with('products')->get();


# 🔥 COMMON SHOP QUERIES
## Homepage catalogo
Product::with([
    'brand',
    'category',
    'variants.media'
])->where('status', ProductStatus::published)->get();

##Product detail page
Product::with([
    'brand',
    'category',
    'variants.media',
    'segments'
])->find($id);

## Checkout (variant)
ProductVariant::with('product')->find($id);
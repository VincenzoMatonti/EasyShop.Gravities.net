<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id')->unique();
            $table->foreign('cart_id')->references('id')->on('carts');
            $table->unsignedBigInteger('product_variant_id')->unique();
            $table->foreign('product_variant_id')->references('id')->on('product_variants');
            $table->unsignedInteger('quantity');
            $table->string('product_name_snapshot');
            $table->string('variant_name_snapshot')->nullable();
            $table->string('sku_snapshot')->nullable();
            $table->string('currency_snapshot', 3);
            $table->decimal('unit_price_snapshot', 10, 2);
            $table->decimal('discount_snapshot', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};

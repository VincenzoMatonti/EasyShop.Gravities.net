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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->morphs('addressable');
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->string('street', 100);
            $table->string('number', 10)->nullable();
            $table->string('zip_code', 10);
            $table->string('city', 100);
            $table->string('province', 100)->nullable();
            $table->string('country', 100);
            $table->boolean('is_shipping')->default(true);
            $table->boolean('is_billing')->default(false);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};

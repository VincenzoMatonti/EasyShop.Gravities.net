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
        Schema::create('customer_profile_customer_segment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_profile_id');
            $table->foreign('customer_profile_id')->references('id')->on('customer_profiles');
            $table->unsignedBigInteger('customer_segment_id');
            $table->foreign('customer_segment_id')->references('id')->on('customer_segments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_profile_segment');
    }
};

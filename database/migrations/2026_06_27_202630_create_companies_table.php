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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name',50)->nullable();
            $table->string('vat_number',11)->unique()->nullable();
            $table->string('tax_code',16)->unique()->nullable();
            $table->string('pec',255)->nullable();
            $table->string('sdi_code',7)->nullable();
            $table->string('website',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};

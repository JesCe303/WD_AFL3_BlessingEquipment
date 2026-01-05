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
        Schema::create('tb_product_detail', function (Blueprint $table) {
            $table->id('id_product_detail');
            $table->unsignedBigInteger('id_product')->unique();
            $table->decimal('weight_product', 10, 2)->nullable(); // Weight in kg
            $table->string('material_product', 100)->nullable();
            
            // Foreign key
            $table->foreign('id_product')->references('id_product')->on('tb_product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_product_detail');
    }
};

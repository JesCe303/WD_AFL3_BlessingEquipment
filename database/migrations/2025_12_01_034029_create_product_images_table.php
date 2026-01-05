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
        Schema::create('tb_product_image', function (Blueprint $table) {
            $table->id('id_product_image');
            $table->unsignedBigInteger('id_product');
            $table->string('image_url');
            $table->boolean('is_primary')->default(false);
            $table->integer('display_order')->default(0);
            
            // Foreign key
            $table->foreign('id_product')->references('id_product')->on('tb_product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_product_image');
    }
};

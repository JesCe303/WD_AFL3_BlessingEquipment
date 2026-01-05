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
        Schema::create('tb_order_items', function (Blueprint $table) {
            $table->id('id_order_item');
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_product');
            $table->integer('quantity');
            $table->decimal('price', 15, 2); // Price at time of purchase
            $table->decimal('subtotal', 15, 2); // price * quantity
            $table->timestamps();
            
            $table->foreign('id_order')->references('id_order')->on('tb_orders')->onDelete('cascade');
            $table->foreign('id_product')->references('id_product')->on('tb_product')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_order_items');
    }
};

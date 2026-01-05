<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Create shopping cart table to store customer's cart items
     */
    public function up(): void
    {
        Schema::create('tb_cart', function (Blueprint $table) {
            $table->id('id_cart');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_product');
            $table->integer('quantity')->default(1); // Quantity of product
            
            // Foreign keys
            $table->foreign('id_user')->references('id_user')->on('tb_user')->onDelete('cascade'); // Customer who owns this cart item
            $table->foreign('id_product')->references('id_product')->on('tb_product')->onDelete('cascade'); // Product in cart
            
            // Prevent duplicate items: one user can only have one entry per product
            $table->unique(['id_user', 'id_product']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_cart');
    }
};

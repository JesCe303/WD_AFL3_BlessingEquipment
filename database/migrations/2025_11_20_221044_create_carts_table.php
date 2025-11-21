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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Customer who owns this cart item
            $table->foreignId('id_product')->references('id_product')->on('tb_product')->onDelete('cascade'); // Product in cart
            $table->integer('quantity')->default(1); // Quantity of product
            $table->timestamps();
            
            // Prevent duplicate items: one user can only have one entry per product
            $table->unique(['user_id', 'id_product']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};

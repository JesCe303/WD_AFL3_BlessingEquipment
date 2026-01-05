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
        Schema::create('tb_favorite', function (Blueprint $table) {
            $table->id('id_favorite');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_product');
            
            // Foreign keys
            $table->foreign('id_user')->references('id_user')->on('tb_user')->onDelete('cascade');
            $table->foreign('id_product')->references('id_product')->on('tb_product')->onDelete('cascade');
            
            // Prevent duplicate favorites: one user can only favorite a product once
            $table->unique(['id_user', 'id_product']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_favorite');
    }
};

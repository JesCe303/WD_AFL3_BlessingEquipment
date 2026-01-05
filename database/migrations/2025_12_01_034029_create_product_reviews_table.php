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
        Schema::create('tb_product_review', function (Blueprint $table) {
            $table->id('id_review');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_product');
            $table->integer('rating')->unsigned(); // Rating 1-5
            $table->text('review_text')->nullable();
            $table->timestamp('review_date')->useCurrent();
            
            // Foreign keys
            $table->foreign('id_user')->references('id_user')->on('tb_user')->onDelete('cascade');
            $table->foreign('id_product')->references('id_product')->on('tb_product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_product_review');
    }
};

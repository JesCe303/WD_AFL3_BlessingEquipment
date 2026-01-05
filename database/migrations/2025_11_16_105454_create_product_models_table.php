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
        // syntax for creating product table (tb_product)
        Schema::create('tb_product', function (Blueprint $table) {

            $table->id('id_product'); //default primary key 'id'

            $table->string('name_product', 150);
            $table->bigInteger('price_product');
            $table->text('description_product');
            $table->integer('stock_product');
            $table->string('image_product')->nullable();

            $table->unsignedBigInteger('id_branch');
            $table->unsignedBigInteger('id_category');

            $table->foreign('id_branch')->references('id_branch')->on('tb_branch')->onDelete('cascade');
            // onDelete cascade means if the branch is deleted, all products in that branch will also be deleted
            $table->foreign('id_category')->references('id_category')->on('tb_category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_product');
    }
};

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
            $table->integer('price_product');
            $table->text('description_product');
            $table->integer('id_category');
            $table->timestamps();
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

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
        Schema::create('tb_category_detail', function (Blueprint $table) {
            $table->id('id_category_detail');
            $table->unsignedBigInteger('id_category')->unique();
            $table->text('additional_info')->nullable();
            
            // Foreign key
            $table->foreign('id_category')->references('id_category')->on('tb_category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_category_detail');
    }
};

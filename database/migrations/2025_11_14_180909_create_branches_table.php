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
        Schema::create('tb_branch', function (Blueprint $table) {
            $table->id('id_branch');
            $table->string('name_branch', 150);
            $table->text('address_branch');
            $table->string('type_branch', 50); // Online/Offline/Hybrid
            $table->string('image_branch')->nullable(); // Branch image upload
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_branch');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Add Role Column to Users Table
 * 
 * Purpose: Differentiate between admin and customer users
 * 
 * Role Types:
 * - 'admin': Full access to product/category/branch CRUD operations
 * - 'customer': Can only view products and use shopping cart
 * 
 * Default: New registrations automatically set as 'customer'
 * Admin accounts must be created via seeder or database
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     * Add role column to differentiate admin and customer users
     */
    public function up(): void
    {
        Schema::table('tb_user', function (Blueprint $table) {
            // Foreign key to tb_role
            $table->unsignedBigInteger('id_role')->after('email_user');
            $table->foreign('id_role')->references('id_role')->on('tb_role')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     * Remove role foreign key when rolling back migration
     */
    public function down(): void
    {
        Schema::table('tb_user', function (Blueprint $table) {
            $table->dropForeign(['id_role']);
            $table->dropColumn('id_role');
        });
    }
};

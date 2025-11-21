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
        Schema::table('users', function (Blueprint $table) {
            // Role: admin (full CRUD access) or customer (view & purchase only)
            // enum: only allows 'admin' or 'customer' values
            // default('customer'): new registrations become customers automatically
            // after('email'): place column after email column
            $table->enum('role', ['admin', 'customer'])->default('customer')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     * Remove role column when rolling back migration
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 * User Seeder - Creates default admin and customer accounts
 * Admin: username@gmail.com / Awawa123 (full CRUD access)
 * Customer: customer@example.com / Password123 (view & purchase only)
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Seeds 1 admin account and 1 customer account for testing
     */
    public function run(): void
    {
        // Create admin account with full access
        User::create([
            'name' => 'Admin User',
            'email' => 'username@gmail.com',
            'password' => Hash::make('Awawa123'),
            'role' => 'admin',
            'email_verified_at' => now()
        ]);

        // Create customer account for testing shopping features
        User::create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'password' => Hash::make('Password123'),
            'role' => 'customer',
            'email_verified_at' => now()
        ]);
    }
}

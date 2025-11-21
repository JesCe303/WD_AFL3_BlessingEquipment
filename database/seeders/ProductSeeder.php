<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Product Seeder - Seeds sample products into database
 * Creates 3 dummy products: 2 in Surabaya branch, 1 in Jakarta branch
 * Used for testing and development purposes
 */
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Inserts sample products with different categories and branches
     */
    public function run(): void
    {
        DB::table('tb_product')->insert([
            // Product 1: Assigned to Surabaya branch, Uncategorized
            [
                'name_product' => 'Laptop XYZ',
                'price_product' => 15000000,
                'description_product' => 'A high-performance laptop suitable for gaming and professional work.',
                'stock_product' => 14,
                'id_category' => 1, // Uncategorized
                'id_branch' => 1,   // Blessing Equipment Surabaya
                'created_at' => now()
            ],
            // Product 2: Assigned to Surabaya branch, Bakery category
            [
                'name_product' => 'Smartphone ABC',
                'price_product' => 5000000,
                'description_product' => 'A sleek smartphone with an impressive camera and long-lasting battery.',
                'stock_product' => 25,
                'id_category' => 2, // Bakery
                'id_branch' => 1,   // Blessing Equipment Surabaya
                'created_at' => now()
            ],
            // Product 3: Assigned to Jakarta branch, Bakery category
            [
                'name_product' => 'Wireless Headphones DEF',
                'price_product' => 2000000,
                'description_product' => 'Noise-cancelling wireless headphones with superior sound quality.',
                'stock_product' => 15,
                'id_category' => 2, // Bakery
                'id_branch' => 2,   // Blessing Equipment Jakarta
                'created_at' => now()
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * Category Seeder - Seeds default product categories
 * Creates 3 categories: Uncategorized (protected), Bakery, Restaurants
 * Uncategorized cannot be deleted - serves as default category
 */
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates initial product categories for spare parts business
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::table('tb_category')->insert([
            // Default category - CANNOT BE DELETED (protected in CategoryController)
            [
                'category_name' => 'Uncategorized',
                'category_description' => 'Default category for uncategorized products.'
            ],
            // Bakery equipment spare parts category
            [
                'category_name' => 'Bakery',
                'category_description' => 'Bakery Spareparts and supplies.'
            ],
            // Restaurant equipment spare parts category
            [
                'category_name' => 'Restaurants',
                'category_description' => 'Spareparts and equipment for restaurants.'
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // query insert data into table tb_product
        DB::table('tb_product')->insert([
            [
                'name_product' => 'Laptop XYZ',
                'price_product' => 15000000,
                'description_product' => 'A high-performance laptop suitable for gaming and professional work.',
                'id_category' => 1,
                'created_at' => now()
            ],
            [
                'name_product' => 'Smartphone ABC',
                'price_product' => 5000000,
                'description_product' => 'A sleek smartphone with an impressive camera and long battery life.',
                'id_category' => 2,
                'created_at' => now()
            ],
            [
                'name_product' => 'Wireless Headphones DEF',
                'price_product' => 2000000,
                'description_product' => 'Noise-cancelling wireless headphones with superior sound quality.',
                'id_category' => 3,
                'created_at' => now()
            ]
        ]);
    }
}

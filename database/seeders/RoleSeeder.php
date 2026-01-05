<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::table('tb_role')->insert([
            [
                'id_role' => 1,
                'name_role' => 'admin'
            ],
            [
                'id_role' => 2,
                'name_role' => 'customer'
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::table('tb_branch')->insert([
            [
                'name_branch' => 'Blessing Equipment Surabaya',
                'address_branch' => 'Darmo Permai Selatan XIII No.33, Surabaya',
                'type_branch' => 'Offline Store'
            ],
            [
                'name_branch' => 'Blessing Equipment Jakarta',
                'address_branch' => 'Jl. Sudirman No.45, Jakarta',
                'type_branch' => 'Offline Store'
            ]
        ]);
    }
}

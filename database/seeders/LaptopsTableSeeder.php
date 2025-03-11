<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaptopsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('laptops')->insert([
            [
                'brand' => 'Dell',
                'model' => 'XPS 13',
                'serial_number' => '12345ABC',
                'specifications' => 'Intel i7, 16GB RAM, 512GB SSD',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'brand' => 'Apple',
                'model' => 'MacBook Pro',
                'serial_number' => '67890XYZ',
                'specifications' => 'M1 Chip, 16GB RAM, 1TB SSD',
                'status' => 'borrowed',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoansTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('loans')->insert([
            [
                'user_id' => 2, 
                'book_id' => 2,
                'laptop_id' => null,
                'loan_date' => now(),
                'loan_period' => 14, 
                'return_date' => null, 
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 3,
                'book_id' => null,
                'laptop_id' => 2, 
                'loan_date' => now(),
                'loan_period' => 7, 
                'return_date' => now()->addDays(7),
                'status' => 'returned',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

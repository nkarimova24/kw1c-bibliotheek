<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityLogTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('activity_log')->insert([
            [
                'loan_id' => 1, 
                'log_name' => 'Loan Created',
                'description' => 'John Doe has borrowed "To Kill a Mockingbird".',
                'subject_type' => 'loan',
                'event' => 'borrowed',
                'subject_id' => 2,
                'causer_type' => 'user',
                'causer_id' => 2, 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'loan_id' => 2, 
                'log_name' => 'Loan Returned',
                'description' => 'Jane Doe has returned a MacBook Pro.',
                'subject_type' => 'loan',
                'event' => 'returned',
                'subject_id' => 2, 
                'causer_type' => 'user',
                'causer_id' => 3, 
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('books')->insert([
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'publisher' => 'Scribner',
                'genre' => 'Fiction',
                'year_published' => 1925,
                'description' => 'A classic novel set in the Roaring Twenties.',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'publisher' => 'J.B. Lippincott & Co.',
                'genre' => 'Fiction',
                'year_published' => 1960,
                'description' => 'A novel about racism and injustice in the Deep South.',
                'status' => 'borrowed',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

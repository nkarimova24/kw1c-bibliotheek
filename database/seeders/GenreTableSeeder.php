<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreTableSeeder extends Seeder
{
    public function run()
    {
        $genres = ['Fictie', 'Non-Fictie', 'Science Fiction', 'Fantasy', 'Thriller', 'Romance', 'Horror'];
        
        foreach ($genres as $genre) {
            Genre::firstOrCreate(['name' => $genre]);
        }
    }
}

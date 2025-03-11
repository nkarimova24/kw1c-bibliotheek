<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $genres = ['Science Fiction', 'Fantasy', 'Mystery', 'Non-fiction', 'History', 'Romance', 'Horror', 'Biography', 'Self-help', 'Technology'];
        $statuses = ['available', 'borrowed'];

        for ($i = 0; $i < 100; $i++) {
            Book::create([
                'title' => $faker->sentence(3),
                'author' => $faker->name,
                'publisher' => $faker->company,
                'genre' => $faker->randomElement($genres),
                'year_published' => $faker->numberBetween(1950, 2024),
                'description' => $faker->paragraph(),
                'status' => $faker->randomElement($statuses),
            ]);
        }
    }
}

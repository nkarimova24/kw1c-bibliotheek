<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;

class LoanTableSeeder extends Seeder
{
    public function run()
    {
        // Controleer of er minstens 5 boeken en 5 gebruikers zijn
        if (Book::count() < 5) {
            $this->command->warn('Er zijn niet genoeg boeken in de database. Voeg eerst boeken toe!');
            return;
        }

        if (User::count() < 5) {
            $this->command->warn('Er zijn niet genoeg gebruikers in de database. Voeg eerst gebruikers toe!');
            return;
        }

        $books = Book::inRandomOrder()->take(5)->get();
        $users = User::inRandomOrder()->take(5)->get();

        foreach ($books as $book) {
            $user = $users->random();

            Loan::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'loan_date' => Carbon::now()->subDays(rand(1, 14)), // Uitleningen van de afgelopen 2 weken
                'loan_period' => 14, // 14 dagen uitleentermijn
                'return_date' => Carbon::now()->subDays(rand(-5, 10)), // Kan al ingeleverd zijn of te laat zijn
                'status' => rand(0, 1) ? 'returned' : 'active',
            ]);
        }

        $this->command->info('Testleningen succesvol toegevoegd!');
    }
}

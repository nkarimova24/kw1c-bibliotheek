<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'student']);

        $this->call([
            UserTableSeeder::class,
            BooksTableSeeder::class,
            LaptopsTableSeeder::class,
            GenreTableSeeder::class,
            LoanTableSeeder::class,
            ActivityLogTableSeeder::class,
           
        ]);
    }
}

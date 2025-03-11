<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $studentRole = Role::firstOrCreate(['name' => 'student']);

        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@library.com',
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $admin->assignRole($adminRole); 

        $john = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@student.com',
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $john->assignRole($studentRole);

        $jane = User::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@student.com',
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $jane->assignRole($studentRole);
    }
}

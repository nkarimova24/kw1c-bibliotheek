<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    public function run()
    {

        if (Role::count() == 0) {
            $this->command->warn('Geen rollen gevonden! Voer eerst "php artisan db:seed --class=RoleSeeder" uit.');
            return;
        }

        
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin3@library.com',
            'password' => Hash::make('password'), 
        ]);
        $admin->assignRole('admin');

        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('student');
        });

        $this->command->info('Admin en studenten succesvol toegevoegd!');
    }
}

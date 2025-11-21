<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin FureverHome',
            'email' => 'admin@fureverhome.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Happy Paws Shelter',
            'email' => 'shelter@fureverhome.com',
            'password' => Hash::make('password'),
            'role' => 'shelter',
        ]);

        User::create([
            'name' => 'John Adopter',
            'email' => 'adopter@fureverhome.com',
            'password' => Hash::make('password'),
            'role' => 'adopter',
        ]);
    }
}

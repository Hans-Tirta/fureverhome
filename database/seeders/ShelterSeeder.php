<?php

namespace Database\Seeders;

use App\Models\Shelter;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShelterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get shelter user yang sudah dibuat di UserSeeder
        $shelterUser = User::where('email', 'shelter@fureverhome.com')->first();

        Shelter::create([
            'user_id' => $shelterUser->id,
            'name' => 'Happy Paws Shelter',
            'address' => 'Jl. Raya Bogor No. 123, Jakarta Timur, DKI Jakarta 13810',
            'phone' => '+62 21 8888 9999',
            'email' => 'info@happypaws.com',
            'description' => 'Happy Paws is a non-profit animal shelter dedicated to rescuing, rehabilitating, and rehoming abandoned and abused animals. We have been serving the Jakarta community since 2015.',
            'website' => 'https://happypaws.com',
            'is_verified' => true,
        ]);

        // Create additional shelter users for testing
        $shelter2 = User::create([
            'name' => 'Paws & Claws Rescue',
            'email' => 'shelter2@fureverhome.com',
            'password' => bcrypt('password'),
            'role' => 'shelter',
        ]);

        Shelter::create([
            'user_id' => $shelter2->id,
            'name' => 'Paws & Claws Rescue',
            'address' => 'Jl. Sudirman No. 456, Bandung, Jawa Barat 40123',
            'phone' => '+62 22 7777 8888',
            'email' => 'contact@pawsclaws.com',
            'description' => 'A rescue organization focused on finding loving homes for cats and dogs in West Java.',
            'website' => 'https://pawsclaws.com',
            'is_verified' => true,
        ]);
    }
}

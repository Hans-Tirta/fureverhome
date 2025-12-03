<?php

namespace Database\Seeders;

use App\Models\Pet;
use App\Models\PetImage;
use App\Models\Shelter;
use App\Models\Category;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shelters = Shelter::all();
        $dogsCategory = Category::where('slug', 'dogs')->first();
        $catsCategory = Category::where('slug', 'cats')->first();
        $birdsCategory = Category::where('slug', 'birds')->first();
        $rabbitsCategory = Category::where('slug', 'rabbits')->first();

        // Dogs
        $dogs = [
            [
                'shelter_id' => $shelters[0]->id,
                'category_id' => $dogsCategory->id,
                'name' => 'Max',
                'age_years' => 2,
                'age_months' => 6,
                'gender' => 'male',
                'size' => 'large',
                'breed' => 'Golden Retriever',
                'color' => 'Golden',
                'description' => 'Max is a friendly and energetic Golden Retriever who loves to play fetch and go for long walks. He is great with children and other dogs. Max is fully trained and knows basic commands. He would be perfect for an active family with a backyard.',
                'health_status' => 'Excellent',
                'vaccination_status' => 'Up to date - Rabies, DHPP, Bordetella',
                'is_neutered' => true,
                'is_house_trained' => true,
                'good_with_kids' => true,
                'good_with_pets' => true,
                'adoption_fee' => 500000,
                'image' => 'https://picsum.photos/seed/dog-max/800/600',
            ],
            [
                'shelter_id' => $shelters[0]->id,
                'category_id' => $dogsCategory->id,
                'name' => 'Luna',
                'age_years' => 1,
                'age_months' => 3,
                'gender' => 'female',
                'size' => 'medium',
                'breed' => 'Beagle Mix',
                'color' => 'Tricolor',
                'description' => 'Luna is a sweet and playful Beagle mix puppy. She loves to cuddle and is very affectionate. Luna is still learning her manners but is eager to please. She would thrive in a home where someone can spend time training her.',
                'health_status' => 'Good',
                'vaccination_status' => 'Up to date',
                'is_neutered' => true,
                'is_house_trained' => false,
                'good_with_kids' => true,
                'good_with_pets' => true,
                'adoption_fee' => 400000,
                'image' => 'https://picsum.photos/seed/dog-luna/800/600',
            ],
            [
                'shelter_id' => $shelters[1]->id,
                'category_id' => $dogsCategory->id,
                'name' => 'Rocky',
                'age_years' => 5,
                'age_months' => 0,
                'gender' => 'male',
                'size' => 'large',
                'breed' => 'German Shepherd',
                'color' => 'Black and Tan',
                'description' => 'Rocky is a loyal and protective German Shepherd. He is well-trained and very obedient. Rocky needs an experienced owner who can provide structure and exercise. He is great as a guard dog and family protector.',
                'health_status' => 'Excellent',
                'vaccination_status' => 'Current',
                'is_neutered' => true,
                'is_house_trained' => true,
                'good_with_kids' => false,
                'good_with_pets' => false,
                'adoption_fee' => 600000,
                'image' => 'https://picsum.photos/seed/dog-rocky/800/600',
            ],
            [
                'shelter_id' => $shelters[1]->id,
                'category_id' => $dogsCategory->id,
                'name' => 'Bella',
                'age_years' => 0,
                'age_months' => 8,
                'gender' => 'female',
                'size' => 'small',
                'breed' => 'Chihuahua',
                'color' => 'Brown',
                'description' => 'Bella is a tiny bundle of energy! This Chihuahua puppy loves attention and being the center of your world. She is perfect for apartment living and would make a great companion for someone looking for a small, portable friend.',
                'health_status' => 'Good',
                'vaccination_status' => 'In progress',
                'is_neutered' => false,
                'is_house_trained' => false,
                'good_with_kids' => false,
                'good_with_pets' => true,
                'adoption_fee' => 350000,
                'image' => 'https://picsum.photos/seed/dog-bella/800/600',
            ],
        ];

        // Cats
        $cats = [
            [
                'shelter_id' => $shelters[0]->id,
                'category_id' => $catsCategory->id,
                'name' => 'Whiskers',
                'age_years' => 3,
                'age_months' => 0,
                'gender' => 'male',
                'size' => 'medium',
                'breed' => 'Domestic Shorthair',
                'color' => 'Orange Tabby',
                'description' => 'Whiskers is a laid-back orange tabby who loves nothing more than lounging in sunny spots and getting head scratches. He is independent but affectionate on his own terms. Perfect for someone looking for a calm companion.',
                'health_status' => 'Excellent',
                'vaccination_status' => 'Up to date - FVRCP, Rabies',
                'is_neutered' => true,
                'is_house_trained' => true,
                'good_with_kids' => true,
                'good_with_pets' => false,
                'adoption_fee' => 300000,
                'image' => 'https://picsum.photos/seed/cat-whiskers/800/600',
            ],
            [
                'shelter_id' => $shelters[0]->id,
                'category_id' => $catsCategory->id,
                'name' => 'Shadow',
                'age_years' => 1,
                'age_months' => 0,
                'gender' => 'female',
                'size' => 'small',
                'breed' => 'Domestic Shorthair',
                'color' => 'Black',
                'description' => 'Shadow is a playful black cat with bright green eyes. She loves chasing toys and climbing cat trees. Shadow is very social and gets along well with other cats. She would do best in a home with another feline friend.',
                'health_status' => 'Good',
                'vaccination_status' => 'Current',
                'is_neutered' => true,
                'is_house_trained' => true,
                'good_with_kids' => true,
                'good_with_pets' => true,
                'adoption_fee' => 250000,
                'image' => 'https://picsum.photos/seed/cat-shadow/800/600',
            ],
            [
                'shelter_id' => $shelters[1]->id,
                'category_id' => $catsCategory->id,
                'name' => 'Simba',
                'age_years' => 0,
                'age_months' => 4,
                'gender' => 'male',
                'size' => 'small',
                'breed' => 'Persian Mix',
                'color' => 'Cream',
                'description' => 'Simba is an adorable Persian mix kitten with fluffy cream-colored fur. He is curious, playful, and loves to explore. Simba needs regular grooming to keep his coat beautiful. He would be perfect for someone who has time to care for his special needs.',
                'health_status' => 'Good',
                'vaccination_status' => 'In progress',
                'is_neutered' => false,
                'is_house_trained' => true,
                'good_with_kids' => true,
                'good_with_pets' => true,
                'adoption_fee' => 400000,
                'image' => 'https://picsum.photos/seed/cat-simba/800/600',
            ],
            [
                'shelter_id' => $shelters[1]->id,
                'category_id' => $catsCategory->id,
                'name' => 'Mittens',
                'age_years' => 7,
                'age_months' => 0,
                'gender' => 'female',
                'size' => 'medium',
                'breed' => 'Domestic Longhair',
                'color' => 'Grey and White',
                'description' => 'Mittens is a senior cat looking for a quiet retirement home. She is gentle, calm, and loves being petted. Mittens would be perfect for an older person or anyone looking for a low-maintenance companion. She has a lot of love left to give.',
                'health_status' => 'Good - Senior wellness checked',
                'vaccination_status' => 'Current',
                'is_neutered' => true,
                'is_house_trained' => true,
                'good_with_kids' => false,
                'good_with_pets' => false,
                'adoption_fee' => 150000,
                'image' => 'https://picsum.photos/seed/cat-mittens/800/600',
            ],
        ];

        // Other Animals
        $others = [
            [
                'shelter_id' => $shelters[0]->id,
                'category_id' => $rabbitsCategory->id,
                'name' => 'Cotton',
                'age_years' => 1,
                'age_months' => 6,
                'gender' => 'female',
                'size' => 'small',
                'breed' => 'Holland Lop',
                'color' => 'White',
                'description' => 'Cotton is a friendly Holland Lop rabbit with beautiful white fur and floppy ears. She loves fresh vegetables and hopping around in a safe play area. Cotton is litter-trained and would make a great indoor pet.',
                'health_status' => 'Excellent',
                'vaccination_status' => 'N/A',
                'is_neutered' => true,
                'is_house_trained' => true,
                'good_with_kids' => true,
                'good_with_pets' => false,
                'adoption_fee' => 200000,
                'image' => 'https://picsum.photos/seed/rabbit-cotton/800/600',
            ],
            [
                'shelter_id' => $shelters[1]->id,
                'category_id' => $birdsCategory->id,
                'name' => 'Tweety',
                'age_years' => 2,
                'age_months' => 0,
                'gender' => 'male',
                'size' => 'small',
                'breed' => 'Cockatiel',
                'color' => 'Yellow and Grey',
                'description' => 'Tweety is a charming cockatiel who loves to whistle and sing. He is social and enjoys interacting with people. Tweety needs a spacious cage and time outside for exercise. He would be great for someone experienced with birds.',
                'health_status' => 'Excellent',
                'vaccination_status' => 'N/A',
                'is_neutered' => false,
                'is_house_trained' => false,
                'good_with_kids' => true,
                'good_with_pets' => false,
                'adoption_fee' => 300000,
                'image' => 'https://picsum.photos/seed/bird-tweety/800/600',
            ],
        ];

        // Insert all pets
        foreach (array_merge($dogs, $cats, $others) as $petData) {
            Pet::create($petData);
        }

        $this->command->info('Created ' . count(array_merge($dogs, $cats, $others)) . ' sample pets');
    }
}

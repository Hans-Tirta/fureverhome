<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Main Categories (PETS)
        $dogs = Category::create([
            'name' => 'Dogs',
            'slug' => 'dogs',
            'description' => 'Man\'s best friend - loyal, loving companions',
            'icon' => '🐶',
            'type' => 'pet',
        ]);

        $cats = Category::create([
            'name' => 'Cats',
            'slug' => 'cats',
            'description' => 'Independent and affectionate feline friends',
            'icon' => '🐱',
            'type' => 'pet',
        ]);

        $other = Category::create([
            'name' => 'Other',
            'slug' => 'other',
            'description' => 'Other unique and special pets',
            'icon' => '🐰',
            'type' => 'pet',
        ]);

        // Subcategories under "Other" (PETS)
        Category::create([
            'parent_id' => $other->id,
            'name' => 'Birds',
            'slug' => 'birds',
            'description' => 'Colorful and cheerful feathered companions',
            'icon' => '🐦',
            'type' => 'pet',
        ]);

        Category::create([
            'parent_id' => $other->id,
            'name' => 'Rabbits',
            'slug' => 'rabbits',
            'description' => 'Gentle and social hopping friends',
            'icon' => '🐰',
            'type' => 'pet',
        ]);

        Category::create([
            'parent_id' => $other->id,
            'name' => 'Small Pets',
            'slug' => 'small-pets',
            'description' => 'Hamsters, guinea pigs, and other small pets',
            'icon' => '🐹',
            'type' => 'pet',
        ]);

        Category::create([
            'parent_id' => $other->id,
            'name' => 'Reptiles & Aquatics',
            'slug' => 'reptiles-aquatics',
            'description' => 'Reptiles, amphibians, and fish',
            'icon' => '🐍',
            'type' => 'pet',
        ]);

        // Article Categories (ARTICLES)
        Category::create([
            'parent_id' => $dogs->id,
            'name' => 'Dogs',
            'slug' => 'dogs-articles',
            'description' => 'Articles about dog care and training',
            'icon' => '🐶',
            'type' => 'article',
        ]);

        Category::create([
            'parent_id' => $cats->id,
            'name' => 'Cats',
            'slug' => 'cats-articles',
            'description' => 'Articles about cat care and behavior',
            'icon' => '🐱',
            'type' => 'article',
        ]);

        Category::create([
            'parent_id' => $other->id,
            'name' => 'Other animal',
            'slug' => 'other-animal-articles',
            'description' => 'Articles about other pets and animals',
            'icon' => '🐰',
            'type' => 'article',
        ]);

        Category::create([
            'parent_id' => $dogs->id,
            'name' => 'General',
            'slug' => 'general-articles',
            'description' => 'General pet care articles',
            'icon' => '📰',
            'type' => 'article',
        ]);
    }
}

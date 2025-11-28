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
        // Main Categories
        $dogs = Category::create([
            'name' => 'Dogs',
            'slug' => 'dogs',
            'description' => 'Man\'s best friend - loyal, loving companions',
            'icon' => '🐶',
        ]);

        $cats = Category::create([
            'name' => 'Cats',
            'slug' => 'cats',
            'description' => 'Independent and affectionate feline friends',
            'icon' => '🐱',
        ]);

        $other = Category::create([
            'name' => 'Other',
            'slug' => 'other',
            'description' => 'Other unique and special pets',
            'icon' => '🐰',
        ]);

        // Subcategories under "Other"
        Category::create([
            'parent_id' => $other->id,
            'name' => 'Birds',
            'slug' => 'birds',
            'description' => 'Colorful and cheerful feathered companions',
            'icon' => '🐦',
        ]);

        Category::create([
            'parent_id' => $other->id,
            'name' => 'Rabbits',
            'slug' => 'rabbits',
            'description' => 'Gentle and social hopping friends',
            'icon' => '🐰',
        ]);

        Category::create([
            'parent_id' => $other->id,
            'name' => 'Small Pets',
            'slug' => 'small-pets',
            'description' => 'Hamsters, guinea pigs, and other small pets',
            'icon' => '🐹',
        ]);

        Category::create([
            'parent_id' => $other->id,
            'name' => 'Reptiles & Aquatics',
            'slug' => 'reptiles-aquatics',
            'description' => 'Reptiles, amphibians, and fish',
            'icon' => '🐍',
        ]);
    }
}

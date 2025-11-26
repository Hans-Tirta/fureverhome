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
        $categories = [
            [
                'name' => 'Dogs',
                'slug' => 'dogs',
                'description' => 'Man\'s best friend - loyal, loving companions',
                'icon' => '🐶',
            ],
            [
                'name' => 'Cats',
                'slug' => 'cats',
                'description' => 'Independent and affectionate feline friends',
                'icon' => '🐱',
            ],
            [
                'name' => 'Birds',
                'slug' => 'birds',
                'description' => 'Colorful and cheerful feathered companions',
                'icon' => '🐦',
            ],
            [
                'name' => 'Rabbits',
                'slug' => 'rabbits',
                'description' => 'Gentle and social hopping friends',
                'icon' => '🐰',
            ],
            [
                'name' => 'Small Furry Friends',
                'slug' => 'small-furry',
                'description' => 'Hamsters, guinea pigs, and other small pets',
                'icon' => '🐹',
            ],
            [
                'name' => 'Other',
                'slug' => 'other',
                'description' => 'Other unique and special pets',
                'icon' => '🐍',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

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
        Category::insert([
            [
                'name' => 'Bank',
                'image' => 'bank.png',
            ],
            [
                'name' => 'Clothing',
                'image' => 'clothing.png',
            ],
            [
                'name' => 'Computer',
                'image' => 'computer.png',
            ],
            [
                'name' => 'Construction',
                'image' => 'construction.png',
            ],
            [
                'name' => 'Education',
                'image' => 'education.png',
            ],
            [
                'name' => 'Food',
                'image' => 'food.png',
            ],
            [
                'name' => 'Furniture',
                'image' => 'furniture.png',
            ],
            [
                'name' => 'Healthcare',
                'image' => 'healthcare.png',
            ],
        ]);
    }
}

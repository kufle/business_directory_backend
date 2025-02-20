<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business>
 */
class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::all()->random()->id,
            'name' => fake()->company(),
            'about' => fake()->paragraph(),
            'address' => fake()->address(),
            'contact' => fake()->phoneNumber(),
            'image' => 'default.png',
            'website' => 'www.example.com',
            'rating' => rand(1,5),
            'user_id' => User::all()->random()->id,
        ];
    }
}

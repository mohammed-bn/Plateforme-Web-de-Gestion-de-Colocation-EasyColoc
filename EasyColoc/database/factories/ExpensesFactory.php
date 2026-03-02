<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expenses>
 */
class ExpensesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->sentence(),
            'amount' => fake()->numberBetween(50, 1000),
            'status' => fake()->randomElement(['paid', 'unpaid']),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }
}

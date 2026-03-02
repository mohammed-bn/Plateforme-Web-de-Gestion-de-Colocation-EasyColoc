<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Expense;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'expense_id' => Expense::factory(),
            'user_id' => User::factory(),
            'amount' => fake()->numberBetween(20, 500),
            'status' => fake()->randomElement(['paid', 'unpaid']),
            'paid_at' => fake()->optional()->date(),
        ];
    }
}

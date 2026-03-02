<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Colocation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Joins>
 */
class JoinsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'joined_at' => fake()->date(),
            'left_at' => fake()->optional()->date(),
            'role' => fake()->randomElement(['member', 'owner']),
            'user_id' => User::factory(),
            'colocation_id' => Colocation::factory(),
        ];
    }
}

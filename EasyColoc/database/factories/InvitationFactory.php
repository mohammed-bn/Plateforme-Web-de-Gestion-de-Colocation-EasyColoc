<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Colocation;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invitation>
 */
class InvitationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => fake()->randomElement(['accepter', 'refuse', 'enattente']),
            'email' => fake()->safeEmail(),
            'token' => Str::random(10),
            'colocation_id' => Colocation::factory(),
        ];
    }
}

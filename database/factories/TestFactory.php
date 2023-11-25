<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Test>
 */
class TestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(11, 14),
            'logic_score' => $this->faker->numberBetween(0, 100),
            'numeric_score' => $this->faker->numberBetween(0, 100),
            'verbal_score' => $this->faker->numberBetween(0, 100),
            'result' => $this->faker->randomElement(['passed', 'failed']),
        ];
    }
}

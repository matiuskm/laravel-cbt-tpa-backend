<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence(),
            'category' => $this->faker->randomElement(['Numeric', 'Verbal', 'Logika']),
            'answer_1' => $this->faker->word(),
            'answer_2' => $this->faker->word(),
            'answer_3' => $this->faker->word(),
            'answer_4' => $this->faker->word(),
        ];
    }
}

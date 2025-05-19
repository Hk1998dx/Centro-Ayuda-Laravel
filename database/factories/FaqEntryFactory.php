<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FaqEntry>
 */
class FaqEntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
{
    $question = $this->faker->sentence();
    return [
        'question' => $question,
        'answer' => $this->faker->paragraph(4),
        'views' => rand(0, 50),
        'score' => rand(10, 50) / 10,
        'score_count' => rand(1, 20),
    ];
}
}

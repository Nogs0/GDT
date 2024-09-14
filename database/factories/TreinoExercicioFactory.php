<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TreinoExercicio>
 */
class TreinoExercicioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'treino_id' => fake()->numberBetween(1, 20),
            'exercicio_id' => fake()->numberBetween(1, 100),
            'series' => fake()->numberBetween(2, 6),
            'repeticoes' => fake()->text(30),
            'estrategia' => fake()->text(30)
        ];
    }
}

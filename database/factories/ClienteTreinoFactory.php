<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClienteTreino>
 */
class ClienteTreinoFactory extends Factory
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
            'cliente_id' => fake()->numberBetween(1, 50),
            'data_inicio' => fake()->dateTimeThisDecade()
        ];
    }
}

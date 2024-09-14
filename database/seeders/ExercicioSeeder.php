<?php

namespace Database\Seeders;

use App\Models\Exercicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExercicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Exercicio::factory()
            ->count(100)
            ->create();
    }
}

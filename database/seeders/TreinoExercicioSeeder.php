<?php

namespace Database\Seeders;

use App\Models\TreinoExercicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TreinoExercicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TreinoExercicio::factory()
            ->count(20)
            ->create();
    }
}

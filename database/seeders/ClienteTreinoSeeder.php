<?php

namespace Database\Seeders;

use App\Models\ClienteTreino;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteTreinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClienteTreino::factory()
            ->count(10)
            ->create();
    }
}

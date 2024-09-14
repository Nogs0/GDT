<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('treino_exercicios', function (Blueprint $table) {
            //colunas
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('treino_id');
            $table->unsignedBigInteger('exercicio_id');
            $table->integer('series');
            $table->string('repeticoes', 200)->default('10');
            $table->string('estrategia')->nullable();

            //constraints
            $table->foreign('treino_id')->references('id')->on('treinos');
            $table->foreign('exercicio_id')->references('id')->on('exercicios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treino_exercicios');
    }
};

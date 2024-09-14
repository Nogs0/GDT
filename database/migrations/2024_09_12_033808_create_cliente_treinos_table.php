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
        Schema::create('cliente_treinos', function (Blueprint $table) {
            //colunas
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('treino_id');
            $table->dateTime('data_inicio')->nullable();
            $table->dateTime('data_fim')->nullable();

            //constraints
            $table->foreign('treino_id')->references('id')->on('treinos');
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_treinos');
    }
};

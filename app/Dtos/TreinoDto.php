<?php

namespace App\Dtos;

use App\Models\Exercicio;
use App\Models\Treino;

class TreinoDto {
    public $id;
    public $nome;
    public $exercicios;

    public function __construct(Treino $treino)
    {
        $this->id = $treino->id;
        $this->nome = $treino->nome;
        $this->exercicios = $treino->exercicios->map(function (Exercicio $exercicio) {
            return new ExercicioDto($exercicio);
        });
    }
}
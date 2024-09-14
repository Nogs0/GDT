<?php

namespace App\Dtos;

use App\Models\Exercicio;

class ExercicioDto {
    public $id;
    public $nome;
    public $repeticoes;
    public $series;
    public $estrategia;

    public function __construct(Exercicio $exercicio) 
    {
        $this->id = $exercicio->id;
        $this->nome = $exercicio->nome;
        $this->repeticoes = $exercicio->pivot->repeticoes;
        $this->series = $exercicio->pivot->series;
        $this->estrategia = $exercicio->pivot->estrategia;
    }
}
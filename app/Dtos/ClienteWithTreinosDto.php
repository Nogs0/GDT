<?php
namespace App\Dtos;

use App\Models\Cliente;
use App\Models\Treino;

class ClienteWithTreinosDto {
    public $nome;
    public $objetivo;
    public $treinos;

    public function __construct(Cliente $cliente)
    {
        $this->nome = $cliente->nome;
        $this->objetivo = $cliente->objetivo;
        $this->treinos = $cliente->treinos->map(function (Treino $treino) {
            return new TreinoListDto($treino);
        });
    } 
}
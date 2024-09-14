<?php
namespace App\Dtos;

use App\Models\Cliente;
class ClienteDto {
    public $nome;
    public $email;
    public $telefone;
    public $objetivo;

    public function __construct(Cliente $cliente)
    {
        $this->nome = $cliente->nome;
        $this->email = $cliente->email;
        $this->telefone = $cliente->telefone;
        $this->objetivo = $cliente->objetivo;
    }
}
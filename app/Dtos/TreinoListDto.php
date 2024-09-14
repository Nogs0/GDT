<?php
namespace App\Dtos;

use App\Models\Treino;

class TreinoListDto {

    public $grupamento_muscular;
    public $foco;

    public function __construct(Treino $treino)
    {
        $this->grupamento_muscular = $treino->grupamento_muscular;
        $this->foco = $treino->foco;
    }
}
<?php
namespace App\Dtos;

class PagedResultDto {
    public $totalItems;
    public $paginaAtual;
    public $items;

    public function __construct(int $totalItems, int $paginaAtual, $items)
    {
        $this->totalItems = $totalItems;
        $this->paginaAtual = $paginaAtual;
        $this->items = $items;
    }
}
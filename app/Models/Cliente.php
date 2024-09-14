<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'telefone', 'objetivo'];

    public function treinos() {
        return $this->belongsToMany(Treino::class, 'cliente_treinos')
        ->withPivot('data_inicio', 'data_fim');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treino extends Model
{
    use HasFactory;

    protected $fillable = ['grupamento_muscular', 'foco'];

    public function exercicios() {
        return $this->belongsToMany(Exercicio::class, 'treino_exercicios')
        ->withPivot('series', 'repeticoes', 'estrategia');
    }
}

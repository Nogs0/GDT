<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreinoExercicio extends Model
{
    use HasFactory;

    protected $fillable = ['treino_id', 'exercicio_id', 'series', 'repeticoes', 'estrategia'];
}

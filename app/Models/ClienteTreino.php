<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteTreino extends Model
{
    use HasFactory;

    protected $fillable = ['treino_id', 'cliente_id', 'data_inicio', 'data_fim'];
}

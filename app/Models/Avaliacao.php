<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes';
    protected $fillable = [
        'nota',
        'comentario',
        'usuario_id',
        'obra_id'
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    protected $table = 'obras';

    protected $fillable = [
        'titulo',
        'tipo',
        'duracao',
        'paginas',
        'descricao',
        'temporada',
        'autor_id',
        'tema_id'
    ];

    public function avaliacoes()
{
    return $this->hasMany(
        Avaliacao::class,
        'obra_id'
    );
}
}

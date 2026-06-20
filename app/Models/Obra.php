<?php

namespace App\Models;
use App\Models\Favorito;
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
    public function autor()
    {
        return $this->belongsTo(
            Autor::class,
            'autor_id'
        );
    }

    public function tema()
    {
        return $this->belongsTo(
            Tema::class,
            'tema_id'
        );
    }
    public function avaliacoes()
    {
        return $this->hasMany(
            Avaliacao::class,
            'obra_id'
        );
    }

    public function favoritos()
    {
        return $this->hasMany(
            Favorito::class,
            'obra_id'
        );
    }
}

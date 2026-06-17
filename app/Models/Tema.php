<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    protected $table = 'temas';

    protected $fillable = [
        'descricao'
    ];

    public function obras()
    {
        return $this->hasMany(
            Obra::class,
            'tema_id'
        );
    }
}
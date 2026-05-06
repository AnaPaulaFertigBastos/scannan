<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuario';

    protected $fillable = [
        'apelido',
        'nome',
        'sobrenome',
        'email',
        'senha',
        'nascimento'
    ];

    protected $hidden = [
        'senha',
    ];

    protected function casts(): array
    {
        return [
            'nascimento' => 'datetime',
        ];
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }
}
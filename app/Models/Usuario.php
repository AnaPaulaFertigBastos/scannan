<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuario extends Authenticatable implements JWTSubject
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function favoritos()
    {
        return $this->hasMany(
            Favorito::class,
            'usuario_id'
        );
    }
}
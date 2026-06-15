
<?php

use App\Http\Controllers\ObraController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home/login', [HomeController::class, 'login']);

Route::post('/usuario/login', [UsuarioController::class, 'login'])->name('login');

Route::middleware('usuario.autenticado')->group(function () {

    Route::get('/filmes', [FilmeController::class, 'index']);

    Route::get('/perfil', [UsuarioController::class, 'perfil']);

});
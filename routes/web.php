
<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\FavoritoController;

use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'login'])
    ->name('home.login');
//FEITO

Route::post('/usuario/login', [UsuarioController::class, 'login'])
    ->name('login');
//FEITO

Route::post('/usuario/registrar', [UsuarioController::class, 'registrar'])
    ->name('usuario.registrar');
//FEITO

Route::get('/registrar', [HomeController::class, 'registrar'])
    ->name('home.registrar');
//FEITO

Route::middleware('usuario.autenticado')->group(function () {

    Route::post('/usuario/logout', [UsuarioController::class, 'logout'])
        ->name('logout');
    //FEITO

    Route::patch('/usuario/alterar-senha', [UsuarioController::class, 'alterarSenha']);
    //FEITO

    Route::patch('/usuario/atualizar-perfil', [UsuarioController::class, 'atualizarPerfil']);
    //FEITO

    Route::get('/usuario/perfil', [UsuarioController::class, 'perfil'])->name('usuario.perfil');
    //FEITO

    Route::get('/usuario/senha', [UsuarioController::class, 'senha'])->name('usuario.senha');
    //FEITO

    Route::delete('/usuario/deletar-conta', [UsuarioController::class, 'deletarConta']);

    Route::post('/autores/criar', [AutorController::class, 'criar']);
    Route::get('/autores/listar', [AutorController::class, 'listar']);
    Route::get('/autores/visualizar/{id}', [AutorController::class, 'visualizar']);
    Route::put('/autores/atualizar/{id}', [AutorController::class, 'atualizar']);
    Route::delete('/autores/deletar/{id}', [AutorController::class, 'deletar']);

    Route::post('/temas/criar', [TemaController::class, 'criar']);
    Route::get('/temas/listar', [TemaController::class, 'listar']);
    Route::get('/temas/visualizar/{id}', [TemaController::class, 'visualizar']);
    Route::put('/temas/atualizar/{id}', [TemaController::class, 'atualizar']);
    Route::delete('/temas/deletar/{id}', [TemaController::class, 'deletar']);

    Route::post('/obras/criar', [ObraController::class, 'criar']);
    //FEITO
    Route::get('/obras/listar', [ObraController::class, 'listarObras'])->name('obras.listar');
    //FEITO

    Route::get('/obras/visualizar/{id}', [ObraController::class, 'visualizarObra'])->name('obras.visualizar');
    //FEITO

    Route::get('/obras/criar', [ObraController::class, 'criarView'])->name('obras.criar');

    Route::put('/obras/atualizar/{id}', [ObraController::class, 'atualizar']);
    Route::delete('/obras/deletar/{id}', [ObraController::class, 'deletar']);

    Route::post('/avaliacoes/avaliar',[AvaliacaoController::class, 'avaliar']);
    Route::get('/avaliacoes/obra/listar/{obraId}',[AvaliacaoController::class, 'listarAvaliacoesObra']);
    Route::get('/avaliacoes/minhas',[AvaliacaoController::class, 'listarMinhasAvaliacoes']);
    Route::put('/avaliacoes/atualizar/{id}',[AvaliacaoController::class, 'atualizar']);
    Route::delete('/avaliacoes/deletar/{id}',[AvaliacaoController::class, 'deletar']);

    Route::post('/favoritos/favoritar/{obraId}', [FavoritoController::class, 'favoritarObra']);
    Route::delete('/favoritos/remover/{obraId}', [FavoritoController::class, 'removerFavorito']);
    Route::get('/favoritos/listar', [FavoritoController::class, 'listarFavoritos']);

});
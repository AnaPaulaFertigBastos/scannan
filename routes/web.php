
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

    Route::get('/autores', [AutorController::class, 'listarTela'])
        ->name('autores.listar');

    Route::get('/autores/criar', [AutorController::class, 'formCriar'])
        ->name('autores.criar.form');

    Route::post('/autores/salvar', [AutorController::class, 'salvarTela'])
        ->name('autores.salvar');

    Route::get('/autores/editar/{id}', [AutorController::class, 'formEditar'])
        ->name('autores.editar.form');

    Route::put('/autores/salvar-edicao/{id}', [AutorController::class, 'salvarEdicao'])
        ->name('autores.salvar.edicao');

    Route::delete('/autores/deletar/{id}', [AutorController::class, 'deletar']);

    Route::delete('/autores/excluir/{id}', [AutorController::class, 'deletarTela'])
        ->name('autores.deletar');

    Route::get('/temas', [TemaController::class, 'listarTela'])
        ->name('temas.listar');

    Route::get('/temas/criar', [TemaController::class, 'formCriar'])
        ->name('temas.criar.form');

    Route::post('/temas/salvar', [TemaController::class, 'salvarTela'])
        ->name('temas.salvar');

    Route::get('/temas/editar/{id}', [TemaController::class, 'formEditar'])
        ->name('temas.editar.form');

    Route::put('/temas/salvar-edicao/{id}', [TemaController::class, 'salvarEdicao'])
        ->name('temas.salvar.edicao');

    Route::delete('/temas/deletar/{id}', [TemaController::class, 'deletar']);
    
    Route::delete('/temas/excluir/{id}', [TemaController::class, 'deletarTela'])
        ->name('temas.deletar');

    Route::patch('/usuario/alterar-senha', [UsuarioController::class, 'alterarSenha']);
    //FEITO

    Route::patch('/usuario/atualizar-perfil', [UsuarioController::class, 'atualizarPerfil']);
    //FEITO

    Route::get('/usuario/perfil', [UsuarioController::class, 'perfil'])->name('usuario.perfil');
    //FEITO

    Route::get('/usuario/senha', [UsuarioController::class, 'senha'])->name('usuario.senha');
    //FEITO

    Route::delete('/usuario/deletar-conta', [UsuarioController::class, 'deletarConta']);

   /* Route::post('/autores/criar', [AutorController::class, 'criar']);
    Route::get('/autores/listar', [AutorController::class, 'listar']);
    Route::get('/autores/visualizar/{id}', [AutorController::class, 'visualizar']);
    Route::put('/autores/atualizar/{id}', [AutorController::class, 'atualizar']);
    Route::delete('/autores/deletar/{id}', [AutorController::class, 'deletar']);*/

   /* Route::post('/temas/criar', [TemaController::class, 'criar']);
    Route::get('/temas/listar', [TemaController::class, 'listar']);
    Route::get('/temas/visualizar/{id}', [TemaController::class, 'visualizar']);
    Route::put('/temas/atualizar/{id}', [TemaController::class, 'atualizar']);
    Route::delete('/temas/deletar/{id}', [TemaController::class, 'deletar']);*/

    Route::post('/obras/criar', [ObraController::class, 'criar']);
    //FEITO
    Route::get('/obras/listar', [ObraController::class, 'listarObras'])->name('obras.listar');
    //FEITO

    Route::get('/obras/visualizar/{id}', [ObraController::class, 'visualizarObra'])->name('obras.visualizar');
    //FEITO

    Route::get('/obras/criar', [ObraController::class, 'criarView'])->name('obras.criar');
    //FEITO 

    Route::put('/obras/atualizar/{id}', [ObraController::class, 'atualizar']);
    //FEITO 
    
    Route::get('/obras/alterar/{id}', [ObraController::class, 'alterarView'])->name('obras.alterar');
    //FEITO 

    Route::delete('/obras/deletar/{id}', [ObraController::class, 'deletar']);

    Route::delete('/obras/excluir/{id}', [ObraController::class, 'deletarTela'])
        ->name('obras.deletar');

    Route::post('/avaliacoes/avaliar',[AvaliacaoController::class, 'avaliar']);
    //FEITO 

    Route::get('/avaliacoes/criar/{obraId}',[AvaliacaoController::class, 'avaliarView'])->name('avaliacoes.criar');
    //FEITO 

    Route::get('/avaliacoes/obra/listar/{obraId}',[AvaliacaoController::class, 'listarAvaliacoesObra'])->name('avaliacoes.obra');
    //FEITO 

    Route::get('/avaliacoes/minhas',[AvaliacaoController::class, 'listarMinhasAvaliacoes']);
    Route::put('/avaliacoes/atualizar/{id}',[AvaliacaoController::class, 'atualizar']);
    //FEITO 


    Route::get('/avaliacoes/atualizar/{id}',[AvaliacaoController::class, 'atualizarView'])->name('avaliacoes.atualizar');
    //FEITO 



    Route::delete('/avaliacoes/deletar/{id}',[AvaliacaoController::class, 'deletar']);

    Route::post('/favoritos/favoritar/{obraId}', [FavoritoController::class, 'favoritarObra']);
    Route::delete('/favoritos/remover/{obraId}', [FavoritoController::class, 'removerFavorito']);
    Route::get('/favoritos/listar', [FavoritoController::class, 'listarFavoritos']);

    Route::post('/favoritos/salvar/{obraId}', [FavoritoController::class, 'favoritarTela'])
        ->name('favoritos.salvar');

    Route::delete('/favoritos/excluir/{obraId}', [FavoritoController::class, 'removerTela'])
        ->name('favoritos.excluir');

    Route::get('/favoritos',[FavoritoController::class, 'listarTela'])
        ->name('favoritos.listar');

});
<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

  Route::get('/teste', function () {
      return response()->json([
          'success' => true,
          'message' => 'API funcionando'
      ]);
  });

  Route::post('/usuario/registrar', [UsuarioController::class, 'registrar']);

  Route::post('/usuario/login', [UsuarioController::class, 'login'])->name('login');

  Route::middleware('auth:api')->group(function () {
    Route::get('/usuario', function (Request $request) {
        return response()->json($request);
    });

    Route::post('/usuario/logout', [UsuarioController::class, 'logout']);
    Route::patch('/usuario/alterar-senha', [UsuarioController::class, 'alterarSenha']);
    Route::patch('/usuario/atualizar-perfil', [UsuarioController::class, 'atualizarPerfil']);
    Route::get('/usuario/perfil', [UsuarioController::class, 'perfil']);
    Route::delete('/usuario/deletar-conta', [UsuarioController::class, 'deletarConta']);
  });
  
    

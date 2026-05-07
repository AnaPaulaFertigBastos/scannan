<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

  Route::get('/teste', function () {
      return response()->json([
          'success' => true,
          'message' => 'API funcionando'
      ]);
  });

  Route::post('/registrar', [UsuarioController::class, 'registrar']);

  Route::post('/login', [UsuarioController::class, 'login'])->name('login');

  Route::middleware('auth:api')->group(function () {
    Route::get('/usuario', function (Request $request) {
        return response()->json($request);
    });

    Route::post('/logout', [UsuarioController::class, 'logout']);
  });
  
    

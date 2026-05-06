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

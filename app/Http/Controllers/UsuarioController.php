<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\ResponseHelper;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

use Exception;


class UsuarioController extends Controller
{
    public function registrar(Request $request)
    {
        try {
            $request->validate([
                'apelido' => 'nullable|string|unique:usuario,apelido',
                'nome' => 'required|string',
                'sobrenome' => 'required|string',
                'email' => 'required|email|unique:usuario,email',
                'senha' => 'required|min:6',
                'nascimento' => 'nullable|date'
            ]);

            $user = Usuario::create([
                'nome' => $request->nome,
                'sobrenome' => $request->sobrenome,
                'email' => $request->email,
                'senha' => Hash::make($request->senha),
                'nascimento' => $request->nascimento,
                'apelido' => $request->apelido,
            ]);

            return ResponseHelper::success($user, 'Usuário criado com sucesso');
        }
        catch(Exception $e) {
            return ResponseHelper::error($e, 401);
        }
    }
}

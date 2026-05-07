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

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'senha' => 'required'
            ]);

            $credentials = [
                'email' => $request->email,
                'password' => $request->senha
            ];

            $token = auth('api')->attempt($credentials);

            if (!$token) {

                return ResponseHelper::error('Credenciais inválidas', 401);

            }

            return ResponseHelper::success([
                'token' => $token
            ], 'Login realizado');
        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(), 401);
        }
    }

    public function logout()
    {
        try {
            auth('api')->logout();

            return ResponseHelper::success(null, 'Logout realizado');
        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(), 401);
        }
    }
}

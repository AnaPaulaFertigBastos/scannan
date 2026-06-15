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
                'apelido' => 'required|string|unique:usuario,apelido',
                'nome' => 'required|string',
                'sobrenome' => 'required|string',
                'email' => 'required|email|unique:usuario,email',
                'senha' => 'required|min:6',
                'nascimento' => 'required|date'
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
            return ResponseHelper::error($e->getMessage(), 401);
        }
    }

    public function login(Request $request)
    {
        // try {
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

                return back()
                ->withInput()
                ->withErrors([
                    'erro' => 'Erro ao realizar login'
                ]);

            }

            session([
                'jwt_token' => $token
            ]);

            return redirect()->route('obras.listar');
    //     }
    //     catch(Exception $e) {
    //         return back()
    //             ->withInput()
    //             ->withErrors([
    //                 'erro' => 'Erro ao realizar login'
    //             ]);
    //     }
     }

    public function logout()
    {
        try {

            $token = session('jwt_token');

            if ($token) {
                auth('api')
                    ->setToken($token)
                    ->logout();
            }

            session()->forget('jwt_token');

            return redirect()->route('home.login');
        }
        catch(Exception $e) {

            session()->forget('jwt_token');

            return redirect()->route('home.login');
        }
    }

    public function alterarSenha(Request $request)
    {
        try {
            $user = auth('api')->user();

            $request->validate([
                'senha_atual' => 'required',
                'nova_senha' => 'required|min:6'
            ]);

            if (!Hash::check($request->senha_atual, $user->senha)) {
                return ResponseHelper::error('Senha atual incorreta', 401);
            }

            $user->senha = Hash::make($request->nova_senha);
            $user->save();

            return ResponseHelper::success(null, 'Senha alterada com sucesso');
        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(), 401);
        }
    }

    public function atualizarPerfil(Request $request)
    {
        try {
            $user = auth('api')->user();

            $request->validate([
                'apelido' => 'required|string|unique:usuario,apelido,' . $user->id,
                'nome' => 'required|string',
                'sobrenome' => 'required|string',
                'email' => 'required|email|unique:usuario,email,' . $user->id,
                'nascimento' => 'required|date'
            ]);

            if ($request->has('nome')) {
                $user->nome = $request->nome;
            }
            if ($request->has('sobrenome')) {
                $user->sobrenome = $request->sobrenome;
            }
            if ($request->has('email')) {
                $user->email = $request->email;
            }
            if ($request->has('nascimento')) {
                $user->nascimento = $request->nascimento;
            }
            if ($request->has('apelido')) {
                $user->apelido = $request->apelido;
            }

            $user->save();

            return ResponseHelper::success($user, 'Perfil atualizado');
        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(), 401);
        }
    }

    public function perfil()
    {
        try {
            $user = auth('api')->user();

            return ResponseHelper::success($user, 'Perfil do usuário');
        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(), 401);
        }
    }
    
    public function deletarConta()
    {
        try {
            $user = auth('api')->user();
            $user->delete();

            return ResponseHelper::success(null, 'Conta deletada');
        }
        catch(Exception $e) {
            return ResponseHelper::error($e->getMessage(), 401);
        }
    }

}

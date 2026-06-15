<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsuarioAutenticado
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $token = session('jwt_token');

        if (!$token) {
            return redirect()->route('login');
        }

        try {
            auth('api')->setToken($token);

            if (!auth('api')->check()) {
                session()->forget('jwt_token');
                return redirect()->route('login');
            }
        } catch (\Exception $e) {
            session()->forget('jwt_token');
            return redirect()->route('login');
        }

        return $next($request);
    }
}

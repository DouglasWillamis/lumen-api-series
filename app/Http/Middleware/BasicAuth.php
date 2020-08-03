<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BasicAuth
{

    public function handle(Request $request, Closure $next)
    {
        $AUTH_USER = env('AUTH_USER');
        $AUTH_PASS = env('AUTH_PASS');
        $forneceuCredenciais = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
        $naoEstaAutenticado = (
            !$forneceuCredenciais ||
            $_SERVER['PHP_AUTH_USER'] !== $AUTH_USER ||
            $_SERVER['PHP_AUTH_PW']   !== $AUTH_PASS
        );
        if ($naoEstaAutenticado) {
            return response()->json(['erro' => 'Não autorizado'], Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}

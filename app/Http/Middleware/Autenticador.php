<?php


namespace App\Http\Middleware;


use App\User;
use Closure;
use Exception;
use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Response;

class Autenticador
{
    public function handle($request, Closure $next)
    {
        try {
            if (!$request->hasHeader('Authorization')) {
                throw new Exception();;
            }
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $dadosAutenticacao = JWT::decode($token, env('PRIVATE_KEY'), ['HS256']);
            $user = User::where('email', $dadosAutenticacao->email)->first();
            if (is_null($user)){
                throw new Exception();
            }
            return $next($request);
        } catch (Exception $e) {
            return response()->json(['erro' => 'Não autorizado'], Response::HTTP_UNAUTHORIZED);
        }
    }

}

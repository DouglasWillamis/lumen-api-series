<?php


namespace App\Http\Middleware;


use App\User;
use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Autenticador
{
    public function handle(Request $request, Closure $next)
    {
        try {
            if (!$request->hasHeader('Authorization')) {
                throw new Exception();;
            }
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $dadosAutenticacao = JWT::decode($token, env('PRIVATE_KEY'), ['HS256']);
            $user = User::where('email', $dadosAutenticacao->sub)->first();
            if (is_null($user)){
                throw new Exception();
            }
            return $next($request);
        } catch (ExpiredException $e) {
            return response()->json(['erro' => 'Token expirado'], Response::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
            return response()->json(['erro' => 'Não autorizado'], Response::HTTP_UNAUTHORIZED);
        }
    }

}

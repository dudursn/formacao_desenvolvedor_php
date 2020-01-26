<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

//Criando nosso proprio autenticador
class Autenticador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try
        {
            //Se uma requisição nao tiver o Authorization no cabeçalho
            if(!$request->hasHeader("Authorization") )
                throw new Exception();

            //Pega os dados do cabeçalho
            $authorizationHeader = $request->header("Authorization");
            //Pega apenas o token de autenticação
            $token = str_replace("Bearer ", "", $authorizationHeader);

            //Decodifica e pega os dados d payload, no caso email e senha com JWT
            $dadosAutenticacao = JWT::decode($token, env("JWT_KEY"), ["HS256"]);
        
            $usuario = User::where('email', $dadosAutenticacao->email)->first();

            if(is_null($usuario)){
                throw new Exception();
            }

        }catch(Exception $e){
            return response()->json("Nao autorizado.");
        }

        return $next($request);
    }
}

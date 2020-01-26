<?php

namespace App\Providers;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Auth\GenericUser;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function (Request $request) {

            //Se uma requisição nao tiver o Authorization no cabeçalho
            if(!$request->hasHeader("Authorization") )
                return null;
            
            //Pega os dados do cabeçalho
            $authorizationHeader = $request->header("Authorization");
            //Pega apenas o token de autenticação
            $token = str_replace("Bearer ", "", $authorizationHeader);

            //Decodifica e pega os dados d payload, no caso email e senha com JWT
            $dadosAutenticacao = JWT::decode($token, env("JWT_KEY"), ["HS256"]);
            
            return User::where('email', $dadosAutenticacao->email)->first();
            
        });
    }
}

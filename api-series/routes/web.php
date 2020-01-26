<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
/** @var \Laravel\Lumen\Routing\Router $router */
$router->get('/', function () use ($router) {
    return $router->app->version();
});

/*Rota de teste
$router->get('/series', function(){
    return [
        "Grey's Anatomy",
        "Flash"
    ];
});
*/
//Grupo de rotas
//$router->group(["prefix" => "api", "middleware" => "auth"], function() use($router){
$router->group(["prefix" => "api", "middleware" => "meu_autenticador"], function() use($router){
    $router->group(["prefix" => "series"], function() use($router){
        /* Sem paginacao */
        $router->get("", "SeriesController@index");
        /* Com paginacao */
        $router->get("paginador", "SeriesController@paginador");

        $router->get("{id}", "SeriesController@show");
        $router->post("", "SeriesController@store");
        $router->put("{id}", "SeriesController@update");
        $router->delete("{id}", "SeriesController@destroy");

        //Subrecursos
        $router->get("{serieId}/episodios", "TemporadasController@buscaPorSerie");
    });

    $router->group(["prefix" => "temporadas"], function() use($router){
        $router->get("", "TemporadasController@index");
        $router->get("{id}", "TemporadasController@show");
        $router->post("", "TemporadasController@store");
        $router->put("{id}", "TemporadasController@update");
        $router->delete("{id}", "TemporadasController@destroy");
    });

    $router->group(["prefix" => "episodios"], function() use($router){
        $router->get("", "EpisodiosController@index");
        $router->get("{id}", "EpisodiosController@show");
        $router->post("", "EpisodiosController@store");
        $router->put("{id}", "EpisodiosController@update");
        $router->delete("{id}", "EpisodiosController@destroy");
    });
    
});

$router->post("/api/login", "TokenController@gerarToken");
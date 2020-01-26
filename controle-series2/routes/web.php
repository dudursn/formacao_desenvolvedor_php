<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

Route::get("/", function () {
    return view("welcome");
});
|
*/



//Testes para fins didáticos
Route::get("/ola", "Pasta\TesteController@inicio");
Route::get("/requisicoes", "SeriesController@testarRequests");

//Aulas
Route::get("/", "SeriesController@index")->name("listar_series");
Route::get("/series", "SeriesController@index")->name("listar_series");

Route::get("/series/criar", "SeriesController@create")
    ->name("form_criar_serie")
    ->middleware('auth');
    
Route::post("/series/criar", "SeriesController@store")->middleware('auth');
Route::post("/series/editar/{id}", "SeriesController@editarSerie")->middleware('auth');
Route::delete("/series/remover/{serie_id}", "SeriesController@destroyWithoutDeleteOnCascade")
    ->name("remover_serie")
    ->middleware('auth');

Route::get("/series/{serie_id}/temporadas", "TemporadasController@index")
    ->name("listar_temporadas");

Route::get("/temporadas/{temporada}/episodios", "EpisodiosController@index")
    ->name("listar_episodios");

Route::post("/temporadas/{temporada}/episodios/assistir", "EpisodiosController@assistir")
    ->name("form_episodios_assistidos")
    ->middleware('auth');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/entrar', 'EntrarController@index')->name('home');
Route::post('/entrar', 'EntrarController@entrar')->name('entrar');
Route::get('/registrar', 'RegistrarController@create')->name('form_registrar');
Route::post('/registrar', 'RegistrarController@store')->name('registrar');

Route::get('/sair', function () {

    Auth::logout();
    return redirect('entrar');
})->name('sair');
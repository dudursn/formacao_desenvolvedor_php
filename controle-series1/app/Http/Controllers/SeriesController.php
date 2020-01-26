<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{
    public function index(Request $request){

		//-Buscar tudo
		//$series = Serie::all(); 

		//- Buscar ordenada
		$series = Serie::query()->orderBy('nome')->get();

		$mensagem = $request->session()->get("mensagem");
		$tipo_alert = $request->session()->get("tipo_alert");

    	return view( "series.index", compact("series", "mensagem", "tipo_alert") );
    	/*
			Ou 
			return view("series.index", [
				"series" => $series,
				"mensagem" => $mensagem
			]);
    		
    	*/
    }

    public function create(){
    	
    	return view("series.create");
	}
	
	public function store(SeriesFormRequest $request){

		//Ou $nome =  $request->get("nome");
		$nome = $request->nome;

		$serie = new Serie();
		$serie->nome = $nome;

		/* 
		Ou
		Serie::create([
			"nome" => $nome
		]);

		Ou
		Serie::create($request->all());
		*/

		if($serie->save()){
			$request->session()
				->flash(
					"mensagem",
					"Série {$serie->id} adicionada com sucesso: {$serie->nome}"
				);
			//	$request->session()->put(...)

			$request->session()
				->flash(
					"tipo_alert",
					"alert-success"
				);
		}
		

		return redirect()->route("listar_series");
	}

	public function destroy (Request $request)
	{
		//Nao funcionou - Serie::destroy($request->serie_id);

		Serie::where("serie_id", "=", $request->serie_id)->delete();

		$request->session()
			->flash(
				"mensagem",
				"Série removida com sucesso"
			);

		return redirect()->route("listar_series");

	}

    public function testarRequests(Request $request){

    	//Mostra a url
    	echo $request->url() . "<br>";

    	//Mostra os parametros querystring
    	var_dump($request->query() );
    	echo "<br>";
    	$id = $request->query("id");
    	$nome = $request->query("nome");
    	echo $id . "<br>";
    	echo $nome . "<br>";
    }
}

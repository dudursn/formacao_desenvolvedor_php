<?php

namespace App\Http\Controllers;

use App\{Serie,Episodio,Temporada};
use Illuminate\Http\Request;

use App\Services\SerieService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{

    public function index(Request $request){

		//-Buscar tudo
		//$series = Serie::all(); 

		//- Buscar ordenada
		$series = Serie::query()->orderBy("nome")->get();

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
	
	public function store(SeriesFormRequest $request, SerieService $serieService){
	
		$serie = $serieService->criarSerie($request->nome, $request->qtd_temporadas, 
			$request->eps_por_temporada);

		if($serie){
			$request->session()
				->flash(
					"mensagem",
					"Série {$serie->nome} e suas temporadas e seus episódios adicionados com sucesso."
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

	public function destroy (Request $request, SerieService $serieService)
	{

		$nomeSerie = $serieService->excluirSerie($request->serie_id);

		if($nomeSerie!=""){
			$request->session()
			->flash(
				"mensagem",
				"Série {$nomeSerie} removida com sucesso"
			);
			$request->session()
				->flash(
					"tipo_alert",
					"alert-success"
				);
		}else{

			$request->session()
			->flash(
				"mensagem",
				"Erro ao remover a Série {$nomeSerie}."
			);
			$request->session()
				->flash(
					"tipo_alert",
					"alert-danger"
				);
		}
	

		return redirect()->route("listar_series");
	}

	public function destroyWithoutDeleteOnCascade(Request $request, SerieService $serieService)
	{
		
		$nomeSerie = $serieService->excluirSerieSemDeleteCascade($request->serie_id);
		
		if($nomeSerie!=""){
			$request->session()
			->flash(
				"mensagem",
				"Série {$nomeSerie} removida com sucesso"
			);
			$request->session()
				->flash(
					"tipo_alert",
					"alert-success"
				);
		}else{

			$request->session()
			->flash(
				"mensagem",
				"Erro ao remover a Série {$nomeSerie}."
			);
			$request->session()
				->flash(
					"tipo_alert",
					"alert-danger"
				);
		}

		return redirect()->route("listar_series");

	}

	public function editarSerie(int $id, Request $request){
		
		$novoNome = $request->nome;
		$serie = Serie::find($id);
		$serie->nome = $novoNome;
		$serie->save();
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

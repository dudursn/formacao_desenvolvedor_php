<?php

namespace App\Http\Controllers;

use App\Serie;
use App\Episodio;
use App\Temporada;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemporadasController extends Controller
{
    public function index(Request $request)
    {
        $serieId = $request->serie_id;

        $serie = Serie::find($serieId)->first();
        
        $serie->temporadas = Temporada::query()
            ->where('serie_id', $serieId)
            ->orderBy('numero')->get();

        $serie->temporadas->each(function(Temporada $temporada){

            $temporada->episodios = Episodio::query()->
                where('temporada_id', $temporada->temporada_id)
                ->orderBy('numero')->get();
        });
     
        $temporadas = $serie->temporadas;
   
        return view( "temporadas.index", compact("serie", "temporadas") );
    }
}

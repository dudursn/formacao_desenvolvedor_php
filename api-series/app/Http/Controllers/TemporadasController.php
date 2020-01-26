<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TemporadaService;
use App\Http\Controllers\BaseController;

class TemporadasController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->classeService = new TemporadaService();
    }

    public function store(Request $request){
        
        return response()
            ->json(
                $this->classeService->criarTemporada(
                    $request->serie_id, $request->numero, $request->eps_por_temporada
                ),
                201
            );
        
    }

    public function show(Request $request){

        $id = $request->id;
      
        $temporada = $this->classeService->findTemporadaById($id, true);

        if(is_null($temporada)){
           
            return response()->json('', 204);
        }
        return response()->json($temporada);
        
    }

    public function buscaPorSerie(int $serieId){

        $temporadas = $this->classeService->findTemporadaBySerieId($serieId, true, false);
        if(is_null($temporadas)){

            return response()->json('', 204);
        }
        return response()->json($temporadas);
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SerieService;
use App\Http\Controllers\BaseController;

class SeriesController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->classeService = new SerieService();
    }

    /* Index com paginação*/
    public function paginador(Request $request){

        $series = $this->classeService->findAllPorPagina($request->page, $request->per_page);
            //->makeHidden(['created_at', 'updated_at'])->toArray();
        return $series;
    }

    public function store(Request $request){
        
        return response()
            ->json(
                $this->classeService->criarSerie(
                    $request->nome, $request->qtd_temporadas, $request->eps_por_temporada
                ),
                201
            );
        
    }

    public function show(Request $request){

        $id = $request->id;
      
        $serie = $this->classeService->findSerieById($id, true);

        if(is_null($serie)){
           
            return response()->json('', 204);
        }
        return response()->json($serie);
        
    }

    
}

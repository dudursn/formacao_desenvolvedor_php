<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\EpisodioService;
use App\Http\Controllers\BaseController;

class EpisodiosController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->classeService = new EpisodioService();
    }

    public function store(Request $request){
        
        return response()
            ->json(
                $this->classeService->criarEpisodio(
                    $request->temporada_id, $request->numero
                ),
                201
            );
        
    }

    public function show(Request $request){

        $id = $request->id;
      
        $episodio = $this->classeService->findEpisodioById($id, true);

        if(is_null($episodio)){
           
            return response()->json('', 204);
        }
        return response()->json($episodio);
        
    }

    
}

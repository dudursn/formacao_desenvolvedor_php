<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

abstract class BaseController extends Controller
{
   
    protected $classeService;

    public function index(){

        $recursos = $this->classeService->findAll(true);

        return $recursos;
    }

    public function update(int $id, Request $request){
       
        $recurso =  $this->classeService->update( $id, $request->valor);
        if(is_null($recurso)){
            return response()->json([
                "erro" => "Recurso nao encontrado."
            ], 404);
        }
        return response()->json($recurso, 201);
    }

    public function destroy(int $id){
       
        $valorRecurso = $this->classeService->excluir($id);
        if(empty($valorRecurso)){
            return response()->json([
                "erro" => "Recurso nao apagado."
            ], 404);
        }
        return response()->json(["$valorRecurso apagado(a) com sucesso"], 204);
    }
}
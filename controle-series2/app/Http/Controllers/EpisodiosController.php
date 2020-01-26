<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Temporada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EpisodiosController extends Controller
{
    public function index(Temporada $temporada, Request $request){
        
        $temporada->episodios = Episodio::query()
            ->where('temporada_id', $temporada->temporada_id)
            ->orderBy('numero')->get();
          
        $episodios = $temporada->episodios;

        $mensagem = $request->session()->get("mensagem");
		$tipo_alert = $request->session()->get("tipo_alert");
     
        return view("episodios.index", compact("temporada", "episodios", "mensagem", "tipo_alert"));
    }

    public function assistir(Temporada $temporada, Request $request){

        $episodiosAssistidos = $request->episodios;
       
        $temporada->episodios = Episodio::query()
            ->where('temporada_id', $temporada->temporada_id)
            ->orderBy('numero')->get();

      
        $temporada->episodios->each(function(Episodio $episodio) 
            use ($episodiosAssistidos) {
            
            DB::beginTransaction();
            $episodio->assistido = in_array($episodio->episodio_id, $episodiosAssistidos);
            $episodio->save();
            DB::commit();
        });

        $episodios = $temporada->episodios;

        $request->session()
            ->flash(
                "mensagem",
                "Lista de episódios assistidos atualizada com sucesso."
            );
        //	$request->session()->put(...)

        $request->session()
            ->flash(
                "tipo_alert",
                "alert-success"
            );
		
        return redirect()->route("listar_episodios", ['temporada' => $temporada] );
        //return redirect()->back()
    }
}

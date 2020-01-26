<?php

namespace App\Services;


use Illuminate\Support\Facades\DB;
use App\{Serie,Episodio,Temporada};

class EpisodioService{

    public function criarEpisodio(int $temporadaId, int $numero) : ?Episodio {

        $episodio = null;
      
        $episodio = Episodio::create([
            "numero" => $numero,
            "temporada_id" => $temporadaId
        ]);

        return $episodio;
    }

    public function update(int $id, int $numero) {
      
        $episodio = Episodio::find($id);
        if($episodio!= null){

		    $episodio->fill([
                "numero" => $numero
            ]);

            $episodio->save();
        }
        return $episodio;
    }

    public function excluir(int $episodioId) : string 
    {
        $numeroEpisodio = "";

        DB::beginTransaction();

        //Nao funcionou - Episodio::destroy($serieId);

        $episodio = Episodio::where("episodio_id", "=", $episodioId)->first();
        if($episodio!=null){
		    $numeroEpisodio = $episodio->numero;
            $episodio->delete();
        }

        DB::commit();
        
        return $numeroEpisodio;
    }

    public function excluirEpisodioSemDeleteCascade(int $episodioId): string
    {
        $numeroEpisodio = "";

        $episodio = Episodio::find($episodioId);     
        
        if($episodio!=null){
            DB::beginTransaction();
            
            $numeroEpisodio = $episodio->numero;

            $episodio->delete();

            DB::commit();
        }
        
        return $numeroEpisodio;
    }

    public function findAll($completo){

         /*$episodios = Episodio::whereRaw("1 = 1")
            ->orderBy('numero')->get(); */
        $episodios = Episodio::all();

        $episodios->each(function(Episodio $episodio) use ($completo){

            $episodio = $this->carregarDados($episodio, $completo);          
        });

        return $episodios;
    }

    public function findEpisodioById(int $episodioId, $completo){

        $episodio = $this->carregarDados(Episodio::where("episodio_id", "=", $episodioId)->first(), $completo);
        return $episodio;
    }

    private function carregarDados($episodio, $completo, $carregarColecao = false){

        if($episodio!=null){
            if($completo){

                $episodio->temporada = Temporada::find($episodio->temporada_id);
            }

            if($carregarColecao){
                
            }
            
        }

        return $episodio;     
    }
}
<?php

namespace App\Services;


use Illuminate\Support\Facades\DB;
use App\{Serie,Episodio,Temporada};

class TemporadaService{

    public function criarTemporada(int $serieId, int $numero, 
        int $epsPorTemporada) : ?Temporada {

        $temporada = null;
        DB::beginTransaction();

        $temporada = Temporada::create([
            "numero" => $numero,
            "serie_id" => $serieId
        ]);

       
        for ($j = 1; $j <= $epsPorTemporada; $j++) {
            $temporada->episodios()->create([
                "numero" => $j,
                "temporada_id" => $temporada->temporada_id
            ]);
        }
    

        DB::commit();

        return $temporada;
    }

    public function update(int $id, int $numero) {
      
        $temporada = Temporada::find($id);
        if($temporada!= null){

		    $temporada->fill([
                "numero" => $numero
            ]);

            $temporada->save();
        }
        return $temporada;
    }

    public function excluir(int $temporadaId) : string 
    {
        $numeroTemporada = "";

        DB::beginTransaction();

        //Nao funcionou - Temporada::destroy($serieId);

        $temporada = Temporada::where("temporada_id", "=", $temporadaId)->first();
        if($temporada!=null){
		    $numeroTemporada = $temporada->numero;
            $temporada->delete();
        }

        DB::commit();
        
        return $numeroTemporada;
    }

    public function excluirTemporadaSemDeleteCascade(int $temporadaId): string
    {
        $numeroTemporada = "";

        $temporada = Temporada::find($temporadaId);     
        
        if($temporada!=null){
            DB::beginTransaction();
            
            $numeroTemporada = $temporada->numero;

            $temporada->episodios = Episodio::where("temporada_id", "=", $temporada->temporada_id)->orderBy("numero")->get();

            $temporada->episodios->each(function (Episodio $episodio) {
                
                $episodio->delete();
            });

            $temporada->delete();

            DB::commit();
        }
        
        return $numeroTemporada;
    }

    public function findAll($completo){

         /*$temporadas = Temporada::whereRaw("1 = 1")
            ->orderBy('numero')->get(); */
        $temporadas = Temporada::all();

        $temporadas->each(function(Temporada $temporada) use ($completo){

            $temporada = $this->carregarDados($temporada, $completo);          
        });

        return $temporadas;
    }

    public function findTemporadaById(int $temporadaId, $completo){

        $temporada = $this->carregarDados(Temporada::where("temporada_id", "=", $temporadaId)->first(), $completo);
        return $temporada;
    }

    public function findTemporadaBySerieId(int $serieId, $completo, $carregarColecao){

        $temporadas = Temporada::where("serie_id", "=", $serieId)->get();

        $temporadas->each(function(Temporada $temporada) use ($completo, $carregarColecao){

            $temporada = $this->carregarDados($temporada, $completo, $carregarColecao);          
        });
        return $temporadas;
    }

    private function carregarDados($temporada, $completo, $carregarColecao= false){
       
        if($temporada!=null){
            if($completo){

                $temporada->serie = Serie::find($temporada->serie_id);
            }
            if($carregarColecao){
                $temporada->episodios = Episodio::query()->
                    where('temporada_id', $temporada->temporada_id)
                    ->orderBy('numero')->get();    

            }
        }

        return $temporada;     
    }
}
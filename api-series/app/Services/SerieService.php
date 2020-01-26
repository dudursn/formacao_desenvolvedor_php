<?php

namespace App\Services;


use Illuminate\Support\Facades\DB;
use App\{Serie,Episodio,Temporada};

class SerieService{

    public function criarSerie(string $nomeSerie, int $qtdTemporadas, 
        int $epsPorTemporada) : ?Serie {

        $serie = null;
        DB::beginTransaction();

        $serie = Serie::create(['nome' => $nomeSerie]);
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create([
                'numero' => $i,
                "serie_id" => $serie->serie_id
            ]);

            for ($j = 1; $j <= $epsPorTemporada; $j++) {
                $temporada->episodios()->create([
                    'numero' => $j,
                    "temporada_id" => $temporada->temporada_id
                ]);
            }
        }

        DB::commit();

        return $serie;
    }

    public function update(int $id, string $nome) {
      
        $serie = Serie::find($id);
        if($serie!= null){

		    $serie->fill([
                "nome" => $nome
            ]);

            $serie->save();
        }
        return $serie;
    }

    public function excluir(int $serieId) : string 
    {
        $nomeSerie = "";

        DB::beginTransaction();

        //Nao funcionou - Serie::destroy($serieId);

        $serie = Serie::where("serie_id", "=", $serieId)->first();
        if($serie!=null){
		    $nomeSerie = $serie->nome;
            $serie->delete();
        }

        DB::commit();
        
        return $nomeSerie;
    }

    public function excluirSerieSemDeleteCascade(int $serieId): string
    {
        $nomeSerie = "";


        $serie = Serie::find($serieId);     
        
        if($serie!=null){
            DB::beginTransaction();
            $nomeSerie = $serie->nome;

            $serie->temporadas = Temporada::query()->where('serie_id', $serieId)->orderBy('numero')->get();
            
            $serie->temporadas->each(function (Temporada $temporada) {

                $temporada->episodios = Episodio::where("temporada_id", "=", $temporada->temporada_id)->orderBy("numero")->get();
        
                $temporada->episodios->each(function (Episodio $episodio) {
                    
                    $episodio->delete();
                });

                $temporada->delete();
            });

            $serie->delete();

            DB::commit();
        }
        
        return $nomeSerie;
    }

    public function findAll($completo){

         /*$series = Serie::whereRaw("1 = 1")
            ->orderBy('nome')->get(); */
        $series = Serie::all();

        $series->each(function(Serie $serie) use ($completo){

            $serie = $this->carregarDados($serie, $completo);          
        });

        return $series;
    }

    public function findAllPorPagina(int $page, int $perPage){
        /*
        Forma 1
        $offset = ($page - 1) * $perPage;
        $series = Serie::query()->offset( $offset )->limit($perPage)->get();
        */

        /*Forma 2 */
        $series = Serie::paginate($perPage);

        return $series;
    }

    public function findSerieById(int $serieId, $completo){

        $serie = $this->carregarDados(Serie::where("serie_id", "=", $serieId)->first(), $completo);
        return $serie;
    }

    private function carregarDados($serie, $completo, $carregarColecao = false){

        if($serie!=null){

            if($completo){

            }

            if($carregarColecao){
                $serie->temporadas = Temporada::query()
                        ->where('serie_id', $serie->serie_id)
                        ->orderBy('numero')->get();  

                $serie->temporadas->each(function(Temporada $temporada){ 

                    $temporada->episodios = Episodio::query()->
                        where('temporada_id', $temporada->temporada_id)
                        ->orderBy('numero')->get();    
                });
            }
        }

        return $serie;     
    }
}
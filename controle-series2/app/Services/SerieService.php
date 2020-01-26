<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\{Serie,Episodio,Temporada};

class SerieService{

    public function criarSerie(string $nomeSerie, int $qtdTemporadas, 
        int $epsPorTemporada) : Serie {

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

    public function excluirSerie(int $serieId) : string 
    {
        $nomeSerie = "";

        DB::beginTransaction();

        //Nao funcionou - Serie::destroy($serieId);

        $serie = Serie::where("serie_id", "=", $serieId)->first();
		$nomeSerie = $serie->nome;
        $serie->delete();

        DB::commit();
        
        return $nomeSerie;
    }

    public function excluirSerieSemDeleteCascade(int $serieId): string
    {
        $nomeSerie = "";


        $serie = Serie::find($serieId);     
        
        
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
        
        return $nomeSerie;
    }
}
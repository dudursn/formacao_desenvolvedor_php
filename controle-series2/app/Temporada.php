<?php

namespace App;

use App\Serie;
use App\Episodio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Temporada extends Model
{
    //

    protected $primaryKey = "temporada_id";

    protected $fillable = ["numero", "serie_id"];

    //Relacionamento OneToMany - Uma temporada tem muitos episodios
     public function episodios(){

        return $this->hasMany(Episodio::class, "episodio_id", "episodio_id");
    }

    //Relacionamento OneToOne - Uma temporada pertence a uma série
    public function serie(){
        
        return $this->belongsTo(Serie::class, "serie_id", "serie_id");
    }
    // Outros relacionamentos belongsTo, hasMany, hasOne, belongsToMany

    public function getEpisodiosAssistidos():Collection{

        return $this->episodios->filter(function (Episodio $episodio) {
            return $episodio->assistido;
        });
    }
    
}

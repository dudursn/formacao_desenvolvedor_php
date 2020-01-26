<?php

namespace App;

use App\Temporada;
use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    //
    protected $primaryKey = "episodio_id";

    protected $fillable = ["numero", "temporada_id"];

    //Relacionamento OneToOne - Um episodio pertence a uma temporada
    public function temporada(){
        
        return $this->belongsTo(Temporada::class, 'temporada_id', 'temporada_id');
    }
    // Outros relacionamentos belongsTo, hasMany, hasOne, belongsToMany
}

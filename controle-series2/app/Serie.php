<?php

namespace App;

use App\Temporada;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model{

    //Nome da tabela
    protected $table = "serie";
    /*
        Eloquent will also assume that each table has a primary key
        column named id. You may define a protected $primaryKey property to 
        override this convention:
    */
    protected $primaryKey = "serie_id";

    //Define quais atributos são preenchíveis
    protected $fillable = ["nome"];

    //Relacionamento OneToMany - Uma série tem muitas temporadas
    public function temporadas(){

        return $this->hasMany(Temporada::class, 'temporada_id', 'temporada_id');
    }
        

    /*
        Indicates if the model should be timestamped.
    public $timestamps = false;
    */

    /*  If your primary key is not an integer,
        you should set the protected $keyType property on your model to string:
    protected $keyType = 'string';
    */


   

}
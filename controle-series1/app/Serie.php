<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model{

    //Nome da tabela
    protected $table = "serie";

    //Define quais atributos são preenchíveis
    protected $fillable = ["nome"];
    
    /*
        Eloquent will also assume that each table has a primary key
        column named id. You may define a protected $primaryKey property to 
        override this convention:
    protected $primaryKey = "serie_id";
    */

    /*
        Indicates if the model should be timestamped.
    public $timestamps = false;
    */

    /*  If your primary key is not an integer,
        you should set the protected $keyType property on your model to string:
    protected $keyType = 'string';
    */


   

}
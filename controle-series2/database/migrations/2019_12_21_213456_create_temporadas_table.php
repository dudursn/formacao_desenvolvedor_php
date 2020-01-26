<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("temporadas", function (Blueprint $table) {
            $table->bigIncrements("temporada_id");
            $table->integer("numero"); 
            
            //Chave estrangeira  e delete on cascade
            $table->unsignedBigInteger("serie_id");
            $table->foreign("serie_id")
                ->references("serie_id")
                ->on("serie")
                ->onDelete("cascade");

            /*Chave estrangeira 
            $table->foreign("serie_id")
                ->references("serie_id")->on("serie")
                
                */
 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("temporadas");
    }
}

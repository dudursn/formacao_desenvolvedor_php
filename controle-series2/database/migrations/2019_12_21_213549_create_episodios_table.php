<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("episodios", function (Blueprint $table) {

            $table->bigIncrements("episodio_id");
            $table->integer("numero");

            //Chave estrangeira e delete on cascade
            $table->unsignedBigInteger("temporada_id");
            $table->foreign("temporada_id")
                ->references("temporada_id")
                ->on("temporadas")
                ->onDelete("cascade");

             /*Chave estrangeira
            $table->foreign("temporada_id")
                ->references("temporada_id")->on("temporadas")
                ->onDelete("cascade");
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
        Schema::dropIfExists("episodios");
    }
}

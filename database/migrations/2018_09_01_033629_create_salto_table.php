<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaltoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salto', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_salto');
            $table->float('puntos_salto');
            $table->integer('id_gimnasta')->unsigned();
            $table->foreign('id_gimnasta')->references('id')->on('gimnastas');
            $table->integer('id_aparato')->unsigned();
            $table->foreign('id_aparato')->references('id_aparato')->on('aparato');
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
        Schema::dropIfExists('salto');
    }
}

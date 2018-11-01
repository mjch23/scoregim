<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGimnastasTable extends Migration
{

    public function up()
    {
        Schema::create('gimnastas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dni');
            $table->integer('edad');
            $table->string('apellido');
            $table->string('nombre');
            $table->string('club');
            $table->string('categoria');
            $table->string('nivel');
            $table->string('observaciones');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('gimnastas');
    }
}

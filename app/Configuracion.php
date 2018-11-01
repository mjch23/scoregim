<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
	protected $table = 'configuraciones';
    protected $fillable = ['id_nivel1','id_nivel2','id_nivel3','id_nivel4'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gimnastas_equipos extends Model
{
       protected $table = 'gimnastas_equipos';
       protected $fillable = ['id','apellido','nombre','club','categoria','nivel','puntos_totales','rana']; //
}

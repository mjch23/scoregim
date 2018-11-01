<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barras extends Model
{
       protected $table = 'barras';
       protected $fillable = ['puntos_barras','id_gimnasta','id_aparato']; //
}

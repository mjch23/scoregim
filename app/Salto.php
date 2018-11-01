<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salto extends Model
{
   	protected $table = 'salto';
       protected $fillable = ['puntos_salto','id_gimnasta','id_aparato'];
    //
}

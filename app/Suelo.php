<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suelo extends Model
{
      	protected $table = 'suelo';
       protected $fillable = ['puntos_suelo','id_gimnasta','id_aparato']; //
}

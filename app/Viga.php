<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viga extends Model
{
          	protected $table = 'viga';
       protected $fillable = ['puntos_viga','id_gimnasta','id_aparato']; //
}

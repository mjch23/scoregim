<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Gimnastas extends Model
{
    //

    protected $fillable = ['dni','edad','apellido','nombre','club','categoria','nivel','observaciones'];



    public function scopeNivel($query, $nivel)
    {
    	if($nivel)
    		return $query->where('nivel','LIKE',"%$nivel%");

    }

        public function scopeClub($query, $club)
    {
    	if($club)
    		return $query->where('club','LIKE',"%$club%");

    }

        public function scopeCategoria($query, $categoria)
    {
    	if($categoria)
    		return $query->where('categoria','LIKE',"%$categoria%");

    }
}


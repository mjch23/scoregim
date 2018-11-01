<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rotacion extends Model
{
    //
    protected $table = 'rotaciones'; // tuve que agregar esto porque me sumaba una 'S' al nombre, seguramente porque no cree la tabla desde línea de comandos y lo hice manualmente desde phpmyadmin https://laracasts.com/discuss/channels/laravel/usign-eloquent-s-is-added-to-database-table-names?page=1
    protected $fillable = ['numero_rotacion','id_gimnasta'];
    protected $casts = ['id_gimnasta' => 'array'];

}
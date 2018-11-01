<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gimnastas;
use App\Rotacion;
use App\Salto;
use App\Suelo;
use App\Viga;
use App\Barras;
use App\Nivel;
use App\Configuracion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id_conf_actual = DB::table('configuraciones')
        ->max('id_conf');

        $conf_actual = DB::table('configuraciones')
        ->select('*')
        ->where('id_conf','=',$id_conf_actual)
        ->first();


        $nivel=Nivel::orderBy('id_nivel')->paginate(25);
        return view('configuracion.index', compact('nivel','conf_actual'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id_conf_actual = DB::table('configuraciones')
        ->max('id_conf');

        $puntaje_maximo = DB::table('configuraciones')
        ->select('puntaje_maximo')
        ->where('id_conf',$id_conf_actual)
        ->first();

        $cantidad_grupos = DB::table('configuraciones')
        ->select('cantidad_grupos')
        ->where('id_conf',$id_conf_actual)
        ->first();

        $longitud = count($request->input('niveles')); //cuenta el tamaño del array que le paso

        $Configuracion = new Configuracion;

     for($i=0;$i<$longitud;$i++) // bucle para recorrer el array
        {

        $niveles_valor = $request->input('niveles')[$i]; // esto es igual al código comentado que está abajo y que funcionó pero sólo para una selección. El implode convertía el array en string pero tenía el problema que para escribir en la BBDD necesitaba concatenar cada numero_rotacion con cada item del array. Saqué la idea del bucle FOR de acá: https://www.anerbarrena.com/php-array-tipos-ejemplos-3876/
       
        $niveles = intval($niveles_valor); // 08/09/18: esto lo tuve que agregar porque me daba error porque no tomaba un valor integer de esta línea (que estaba originalmente arriba): $id_gimnasta = $request->input('id_gimnasta')[$i]; Lo que hace el agregado es extraer el valor entero de la cadena que sale de la línea superior que es recorrida  por el array


        if($niveles==1){

        $Configuracion->id_nivel1 = 1; 

        } 

        else if ($niveles==2) {$Configuracion->id_nivel2 = 2;}
                else if ($niveles==3) {$Configuracion->id_nivel3 = 3;}
                     else if ($niveles==4) {$Configuracion->id_nivel4 = 4;}


        } 

        $Configuracion->puntaje_maximo = $puntaje_maximo->puntaje_maximo;
        $Configuracion->cantidad_grupos = $cantidad_grupos->cantidad_grupos;        
        $Configuracion->save();
        
      /*  $niveles = implode(',', $request->input('niveles'));

        $Configuracion = new Configuracion;
        $Configuracion->id_nivel1 = request('niveles')[0];
        $Configuracion->id_nivel2 = request('niveles')[1];
        $Configuracion->id_nivel3 = request('niveles')[2];
        $Configuracion->id_nivel4 = request('niveles')[3];

        $Configuracion->save(); */


        return view('Configuracion.home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $id_conf_actual = DB::table('configuraciones')
        ->max('id_conf');

        if($request->puntaje_maximo!=NULL){

        DB::table('configuraciones')
        ->where('id_conf',$id_conf_actual)
        ->update(['puntaje_maximo'=>$request->puntaje_maximo]);

        }

        if($request->cantidad_grupos!=NULL){

        DB::table('configuraciones')
        ->where('id_conf',$id_conf_actual)
        ->update(['cantidad_grupos'=>$request->cantidad_grupos]);

        }

        return view('Configuracion.home');
        


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

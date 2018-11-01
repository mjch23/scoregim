<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gimnastas;
use App\Rotacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BarrasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    // lógica para pasar la cantidad de grupos a la vista de rotaciones


        $id_conf_actual = DB::table('configuraciones')
        ->max('id_conf');

        $cantidad_grupos = DB::table('configuraciones')
        ->select('cantidad_grupos')
        ->where('id_conf',$id_conf_actual)
        ->first();

        $arraygrupos = [];

        for($i=0;$i<$cantidad_grupos->cantidad_grupos;$i++){

        $arraygrupos[$i]=$i+1;

        }
  
 // ---------------------------------------------------------------- 

    $id_aparato = 4; // asigna valor al aparato
    Session::flash('id_aparato', $id_aparato); //conserva el dato hasta el próximo controlador

        // Toda esta lógica de abajo es para hacer el filtro por Configuracion

    $max = DB::table('configuraciones')
    ->select('*')
    ->max('id_conf'); // recupera la última configuracion cargada

    $configuracion = DB::table('configuraciones')
    ->select('*')
    ->where('id_conf',$max)
    ->first(); // recupera la fila completa con toda la última configuración cargada


    // Acá termina ----------------------------------------------------------------


    $numero_rotacion = $request->input("numero_rotacion");

    $id_gimnasta = DB::table('rotaciones')->where('numero_rotacion', '=', $numero_rotacion)->pluck('id_gimnasta')->toArray(); // lee la table rotaciones y hace la query para traer solo aquellos id_gimnasta de acuerdo al número de rotación

            $gimnasta = DB::table('gimnastas')
            ->leftJoin('barras', 'gimnastas.id', '=', 'barras.id_gimnasta')         
            ->select('gimnastas.*','barras.puntos_barras as puntos')
            ->orderBy('id')
            ->whereIn('id',$id_gimnasta)
                        ->where(function($query) use ($configuracion){
                            $query->where('nivel','=', $configuracion->id_nivel1)
                                    ->orWhere('nivel','=', $configuracion->id_nivel2)
                                    ->orWhere('nivel','=', $configuracion->id_nivel3)
                                    ->orWhere('nivel','=', $configuracion->id_nivel4);
            })
            ->get();

     /* $gimnasta=Gimnastas::orderBy('id')
      ->whereIn('id',$id_gimnasta)
      ->paginate(25);*/
      return view('Barras.index', compact ('gimnasta','arraygrupos'));

        //
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

    public function select($id)
    {  

// Pasa el puntaje máximo a la vista para parametrizar 

    $id_conf_actual = DB::table('configuraciones')
    ->max('id_conf');

    $puntaje_maximo = DB::table('configuraciones')
    ->select('puntaje_maximo')
    ->where('id_conf',$id_conf_actual)
    ->first();

// ---------------------------------------------------

    $gimnasta = DB::table('gimnastas')->where('id',$id)->get();
    if(count($gimnasta)>0)$gimnasta = $gimnasta[0]->id; 

    return view('puntaje.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

// Pasa el puntaje máximo a la vista para parametrizar 

    $id_conf_actual = DB::table('configuraciones')
    ->max('id_conf');

    $puntaje_maximo = DB::table('configuraciones')
    ->select('puntaje_maximo')
    ->where('id_conf',$id_conf_actual)
    ->first();

// ---------------------------------------------------
            $gimnastas = DB::table('gimnastas')
            ->join('barras', 'gimnastas.id', '=', 'barras.id_gimnasta')         
            ->select('gimnastas.*','barras.puntos_barras as puntos')
            ->orderBy('id')
            ->where('id',$id) // antes tenía whereIn al igual que en la query de arriba, y no funcionaba
            ->get(); 


       // $gimnastas=Gimnastas::find($id);
 
        return view('barras.edit',compact('gimnastas','puntaje_maximo'));//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[ 'puntos'=>'required']);

        DB::table('barras')
        ->where('id_gimnasta',$id)
        ->update(['puntos_barras'=>$request->puntos]);


        return view('puntaje.editado',compact('gimnastas','barras')); //
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gimnastas;
use App\Rotacion;
use App\Suelo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SueloController extends Controller
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

    $id_aparato = 2; // asigna valor al aparato
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
            ->leftJoin('suelo', 'gimnastas.id', '=', 'suelo.id_gimnasta')         
            ->select('gimnastas.*','suelo.puntos_suelo as puntos')
            ->orderBy('id')
            ->whereIn('id',$id_gimnasta)
            //->whereIn('nivel',$configuracion)
            //->where('nivel','=', $configuracion->id_nivel4)
            //->where('nivel','=', $configuracion->id_nivel3)
             // FUNCIONA. Tengo que encontrar la manera de pasar los parámatros de $configuracion a la consulta. El tema es que la base de datos tiene un string en Nivel y habría que cambiar a integer

            ->where(function($query) use ($configuracion){
                            $query->where('nivel','=', $configuracion->id_nivel1)
                                    ->orWhere('nivel','=', $configuracion->id_nivel2)
                                    ->orWhere('nivel','=', $configuracion->id_nivel3)
                                    ->orWhere('nivel','=', $configuracion->id_nivel4);
            }) //https://stackoverflow.com/questions/34896236/laravel-where-has-passing-additional-arguments-to-function (por el tema de USE) La función es por el orWhere (en la documentación de Laravel recomienda meter los orWhere anidados dentro de una función para evitar comportamientos indeseados)
            ->get(); // Funcionó. La clave fue el LeftJoin



        /*   $puntos_suelo = DB::table('suelo')
            ->select('puntos_suelo','id_gimnasta')
           // ->whereIn('id_gimnasta',$id_gimnasta)
      //      ->where('id_gimnasta','=', 27)
            ->orderBy('id_gimnasta')
            ->get()->toArray();  */ // También anduvo. En este caso trae solamente los id_gimnasta que encuentra en la tabla suelo. Habria que hacer un bucle for para que si no encuentra el Id_gimnasta deje el puntaje en null

     //       dd($puntos_suelo);

       /* $puntos_suelo=DB::table('gimnastas_puntos_totales')
        ->whereIn('id',$id_gimnasta)
        ->paginate(25); */

       // dd($puntos_suelo);



    //  $gimnasta=Gimnastas::orderBy('id')
   //   ->whereIn('id',$id_gimnasta)
    //  ->paginate(25);
      return view('Suelo.index', compact ('gimnasta','arraygrupos')); 

   // return view('Suelo.index', compact ('gimnasta','puntos_suelo')); // agregar el puntos_suelo hizo que se solucionara el problema que cuando pasaba la variable no la encontraba

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
            ->join('suelo', 'gimnastas.id', '=', 'suelo.id_gimnasta')         
            ->select('gimnastas.*','suelo.puntos_suelo as puntos')
            ->orderBy('id')
            ->where('id',$id) // antes tenía whereIn al igual que en la query de arriba, y no funcionaba
            ->get(); 


       // $gimnastas=Gimnastas::find($id);
 
        return view('suelo.edit',compact('gimnastas','puntaje_maximo'));
    //
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

        DB::table('suelo')
        ->where('id_gimnasta',$id)
        ->update(['puntos_suelo'=>$request->puntos]);


        return view('puntaje.editado',compact('gimnastas','suelo'));

 
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

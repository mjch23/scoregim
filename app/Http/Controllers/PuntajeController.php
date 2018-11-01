<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gimnastas;
use App\Rotacion;
use App\Salto;
use App\Suelo;
use App\Viga;
use App\Barras;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Validation\Validator;

class PuntajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    // Pasa el puntaje máximo a la vista para parametrizar 

    $id_conf_actual = DB::table('configuraciones')
    ->max('id_conf');

    $puntaje_maximo = DB::table('configuraciones')
    ->select('puntaje_maximo')
    ->where('id_conf',$id_conf_actual)
    ->first();

// ---------------------------------------------------


     $gimnasta=Gimnastas::orderBy('id')->paginate(25);
      return view('Salto.index', compact ('gimnasta','puntaje_maximo'));    //
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

    public function select($id) // sacar el $request
    {  

    // Pasa el puntaje máximo a la vista para parametrizar 

    $id_conf_actual = DB::table('configuraciones')
    ->max('id_conf');

    $puntaje_maximo = DB::table('configuraciones')
    ->select('puntaje_maximo')
    ->where('id_conf',$id_conf_actual)
    ->first();

// ---------------------------------------------------

 //   $id_aparato = $request->input('id_aparato');
    $id_aparato = Session::get('id_aparato'); // recibo desde el controlador anterior
    Session::flash('id_aparato', $id_aparato);  // envío al próximo controlador


    //$gimnasta=Gimnastas::find($id);
    //$gimnasta = DB::table('gimnastas')->where('id',$id)->get();
    $gimnasta=Gimnastas::where('id',$id)->paginate(1);
    //dd($gimnasta);
    //if(count($gimnasta)>0)$gimnasta = $gimnasta[0]->id; 
    //return View::make('Salto.index')->with('gimnasta',$gimnasta);
    return view('puntaje.index',compact('gimnasta','puntaje_maximo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    // Pasa el puntaje máximo a la vista para parametrizar 

    $id_conf_actual = DB::table('configuraciones')
    ->max('id_conf');

    $puntaje_maximo = DB::table('configuraciones')
    ->select('puntaje_maximo')
    ->where('id_conf',$id_conf_actual)
    ->first();

// ---------------------------------------------------

    $this->validate($request, [
        'puntos_aparato' => 'bail|numeric|required|min:0|max:{{$puntaje_maximo->puntaje_maximo}}'
    ]);

        
    $puntos_aparato = $request->input('puntos_aparato');
    $id_gimnasta = $request->input('id');
    $id_aparato = Session::get('id_aparato'); // lo traigo desde select. Salió de acá https://laraveles.com/foro/viewtopic.php?id=4505

    //$id_aparato = $request->input('id_aparato'); // funcionó... tengo que ver cómo hacer que puntaje.index identifique de qué aparato viene así tengo sólo una pantalla de carga de puntajes...
    //Y después de eso, tener un IF o un CASE a continuación para elegir si escribe en Salto, Viga, etc.
    
    switch($id_aparato){

    case 1:
    $salto= new Salto;
    $salto->puntos_salto = $puntos_aparato;
    $salto->id_gimnasta = $id_gimnasta;
    $salto->id_aparato = $id_aparato;
    $salto->save();
    break;

    case 2:
    $suelo= new Suelo;
    $suelo->puntos_suelo = $puntos_aparato;
    $suelo->id_gimnasta = $id_gimnasta;
    $suelo->id_aparato = $id_aparato;
    $suelo->save();
    break;

    case 3:
    $viga= new Viga;
    $viga->puntos_viga = $puntos_aparato;
    $viga->id_gimnasta = $id_gimnasta;
    $viga->id_aparato = $id_aparato;
    $viga->save();
    break;

    case 4:
    $barras= new Barras;
    $barras->puntos_barras = $puntos_aparato;
    $barras->id_gimnasta = $id_gimnasta;
    $barras->id_aparato = $id_aparato;
    $barras->save();
    break;

    }

        return view('Puntaje.home',compact('id_aparato')); // Esto hay que corregirlo, es temporal

    // return view('Salto.index', compact('gimnasta'));
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
    public function update(Request $request, $id)
    {
        //
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

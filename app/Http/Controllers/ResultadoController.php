<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gimnastas;
use App\Rotacion;
use App\Salto;
use App\Suelo;
use App\Viga;
use App\Barras;
use App\Resultado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Collection;

class ResultadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    // Toda esta lógica de abajo es para hacer el filtro por Configuracion

    $max = DB::table('configuraciones')
    ->select('*')
    ->max('id_conf'); // recupera la última configuracion cargada

    $configuracion = DB::table('configuraciones')
    ->select('*')
    ->where('id_conf',$max)
    ->first(); // recupera la fila completa con toda la última configuración cargada


    // Acá termina ----------------------------------------------------------------


        $gimnasta = DB::table('gimnastas')
            ->join('salto', 'gimnastas.id', '=', 'salto.id_gimnasta')
            ->join('suelo', 'gimnastas.id', '=', 'suelo.id_gimnasta')
            ->join('viga', 'gimnastas.id', '=', 'viga.id_gimnasta')
            ->join('barras', 'gimnastas.id', '=', 'barras.id_gimnasta')           
            ->select('gimnastas.*', 'salto.puntos_salto', 'suelo.puntos_suelo','viga.puntos_viga','barras.puntos_barras',DB::raw('(salto.puntos_salto+suelo.puntos_suelo+viga.puntos_viga+barras.puntos_barras) as puntos_totales'))
            ->where(function($query) use ($configuracion){
                            $query->where('nivel','=', $configuracion->id_nivel1)
                                    ->orWhere('nivel','=', $configuracion->id_nivel2)
                                    ->orWhere('nivel','=', $configuracion->id_nivel3)
                                    ->orWhere('nivel','=', $configuracion->id_nivel4);
            }) 
            ->orderBy('puntos_totales','desc')
            ->get();

   /*    $puntos_totales = DB::table('salto')
            ->select(DB::raw('(salto.puntos_salto+suelo.puntos_suelo+viga.puntos_viga+barras.puntos_barras) as puntos_totales'))
            ->join('suelo', 'salto.id_gimnasta', '=', 'suelo.id_gimnasta')
            ->join('viga', 'salto.id_gimnasta', '=', 'viga.id_gimnasta')
            ->join('barras', 'salto.id_gimnasta', '=', 'barras.id_gimnasta') 
        //    ->where('suelo.id_gimnasta','=',27)
            ->get();



        $merged = $lista_gimnasta->merge($puntos_totales); */

    // Cálculo de resultados por equipos

        $porequipos = DB::table('gimnastas_equipos')
        ->select('*')
        ->where(function($query) use ($configuracion){
        $query->where('nivel','=', $configuracion->id_nivel1)
                ->orWhere('nivel','=', $configuracion->id_nivel2)
                ->orWhere('nivel','=', $configuracion->id_nivel3)
                ->orWhere('nivel','=', $configuracion->id_nivel4);
            }) 
        ->orderBy('club')
        ->get();

        // Finalmente lo que hice fue crear una vista nueva con los resultados de la query que arma los rankings
        // porque se complicaba bastante armar el equivalente en Eloquent. Sin embargo me daba error 1055 
        // error que no tenía cuando la consulta era sobre la vista original (gimnastas_pts_equipos)
        // tuve que deshabilitar "strict" en config/database.php para que funcione. Esto salió de acá:
        // https://stackoverflow.com/questions/40917189/laravel-syntax-error-or-access-violation-1055-error

    // Acá termina ----------------------------------------------------------------


        return view('Resultado.index', compact('gimnasta','porequipos')); //
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

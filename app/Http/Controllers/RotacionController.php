<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gimnastas;
use App\Rotacion;
use Illuminate\Support\Facades\DB;

class RotacionController extends Controller
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

        $rotacion=Rotacion::orderBy('id_rotacion'); // lo agregué a última hora. Tengo que encontrar la manera de poder filtrar la vista de Rotaciones de acuerdo a si existe o no un id_gimnasta grabado (para ir eliminando items de la lista)

        $nivel = $request->get('nivel');
        $club = $request->get('club');
        $categoria = $request->get('categoria');

        //$cuenta = count(DB::table('rotaciones')->get()); // cuenta la cantidad de filas que tiene la tabla rotaciones
        
        //for($i=0;$i<$cuenta;$i++)

            //{

            //$puntero=0;
            $id_gimnasta = DB::table('rotaciones')->pluck('id_gimnasta')->toArray(); // funciona: extrae el valor a un array
            //$id = DB::table('gimnastas')->where('id',$id_gimnasta)->get(); // trunco, revisar qué se puede hacer con esto
            //if(count($id)>0)$id = $id[0]->id; // extrae el valor de id del vector. Salió de https://stackoverflow.com/questions/30754782/how-to-get-an-item-from-a-collection-in-laravel-5

            //dd($id_gimnasta); // 1:08.. hasta acá llegué... se cómo recorrer una tabla, tengo que terminar la otra

                $gimnasta=Gimnastas::orderBy('id')
                ->whereNotIn('id',$id_gimnasta) // cuando le saqué los corchetes a id_gimnasta empezó a andar
                ->nivel($nivel)
                ->club($club)
                ->categoria($categoria)
                ->paginate(25);
   

        //}

        return view('Rotacion.index', compact('gimnasta','arraygrupos'));//

 
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

        $longitud = count($request->input('id_gimnasta')); //cuenta el tamaño del array que le paso




        for($i=0;$i<$longitud;$i++) // bucle para recorrer el array
        {

        $id_gimnasta_valor = $request->input('id_gimnasta')[$i]; // esto es igual al código comentado que está abajo y que funcionó pero sólo para una selección. El implode convertía el array en string pero tenía el problema que para escribir en la BBDD necesitaba concatenar cada numero_rotacion con cada item del array. Saqué la idea del bucle FOR de acá: https://www.anerbarrena.com/php-array-tipos-ejemplos-3876/
       
        $id_gimnasta = intval($id_gimnasta_valor); // 08/09/18: esto lo tuve que agregar porque me daba error porque no tomaba un valor integer de esta línea (que estaba originalmente arriba): $id_gimnasta = $request->input('id_gimnasta')[$i]; Lo que hace el agregado es extraer el valor entero de la cadena que sale de la línea superior que es recorrida  por el array

        $Rotacion = new Rotacion;
        $Rotacion->numero_rotacion = request('numero_rotacion');
        $Rotacion->id_gimnasta = $id_gimnasta;
        $Rotacion->save();

        }

       /* $id_gimnasta = implode(',', $request->input('id_gimnasta'));
        $Rotacion = new Rotacion;
        $Rotacion->numero_rotacion = request('numero_rotacion');
        $Rotacion->id_gimnasta = $id_gimnasta;
        $Rotacion->save(); */


        return view('Rotacion.home');


  /* -----------------------------------------------------------------------
     $this->validate($request, [

        'numero_rotacion' => 'required',
    
        'id_gimnasta' => 'required'
    ]);

     //$numero_rotacion = $request->input('numero_rotacion');
      // $id_gimnasta = $request->input('id_gimnasta');
       // $id_gimnasta = implode(',', $request->input('id_gimnasta'));


   

       //dd($id_gimnasta, $numero_rotacion);


       Rotacion::create($request->all());

       //$numero_rotacion->save();
       //$id_gimnasta->save();

        return view('Rotacion.index', compact('gimnasta'));

---------------------Este código es el que da como error String to Array SQL Error

        */



      //  Rotacion::create($request->all());
      //  return view('Rotacion.index', compact('gimnasta'));


        //return view('Rotacion.index', compact('gimnasta'));

      //  dd($request->all());

      //  $myCheckboxes = $request->input('numero_rotacion');
       // dd($myCheckboxes); // para comprobar si están llegando las variables hasta acá

   /* $numero_rotacion = Rotacion::create(['numero_rotacion' => $request->input('numero_rotacion')]);
       $id_gimnasta = Rotacion::create(['id_gimnasta' => implode(',', $request->input('id_gimnasta'))]);*/

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

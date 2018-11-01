<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gimnastas;

class GimnastasController extends Controller
{

    public function index()
    {
        $gimnasta=Gimnastas::orderBy('id')->paginate(25);
        return view('Gimnastas.index', compact('gimnasta'));//
    }


    public function create()
    {
        return view('Gimnastas.create');//
    }


    public function store(Request $request)
    {
       $this->validate($request,[ 'apellido'=>'required', 'nombre'=>'required', 'club'=>'required', 'categoria'=>'required', 'nivel'=>'required']);
        Gimnastas::create($request->all());
        return redirect()->route('gimnastas.index')->with('success','Registro creado satisfactoriamente');
     //
    }


    public function show($id)
    {
        $gimnastas=Gimnastas::find($id);
        return  view('gimnastas.show',compact('gimnasta')); //23-08-18 Esta línea tenía gimnastas.show. Lo cambié a gimnastas.import para que funcionen las rutas... hay que corregir esto
    }


    public function edit($id)
    {
        $gimnastas=Gimnastas::find($id);
        return view('gimnastas.edit',compact('gimnastas')); //
    }


    public function update(Request $request, $id)
    {


        $this->validate($request,[ 'apellido'=>'required', 'nombre'=>'required', 'club'=>'required', 'categoria'=>'required', 'nivel'=>'required']);
 
        Gimnastas::find($id)->update($request->all());
        return redirect()->route('gimnastas.index')->with('success','Registro actualizado satisfactoriamente');
 //
    }


    public function destroy($id)
    {
        Gimnastas::find($id)->delete();
        return redirect()->route('gimnastas.index')->with('success','Registro eliminado satisfactoriamente');//
    }

        public function import()
    {
        return view('Gimnastas.import');//
    }


}

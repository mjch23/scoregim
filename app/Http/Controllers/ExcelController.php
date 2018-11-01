<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Gimnastas;

class ExcelController extends Controller
{
    public function importUsers(Request $request)
{
    \Excel::load($request->excel, function($reader) {

        $excel = $reader->get();

        // iteracción
        $reader->each(function($row) {

            $gimnasta = new Gimnastas;
            $gimnasta->dni = $row->dni;
            $gimnasta->edad = $row->edad;
            $gimnasta->apellido = $row->apellido;
            $gimnasta->nombre = $row->nombre; 
            $gimnasta->club = $row->club;
            $gimnasta->categoria = $row->categoria;
            $gimnasta->nivel = $row->nivel;
            $gimnasta->observaciones = $row->observaciones;
            $gimnasta->save();

        });
    
    });

    return redirect()->route('gimnastas.index');
}



    //
}

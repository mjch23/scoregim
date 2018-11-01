@extends('layouts.app')
@section('content')

  <section class="content">

      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Lista Gimnastas</h3>
          <div class="table-responsive">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Apellido</th>
               <th>Nombre</th>
               <th>Club</th>
               <th>Categoría</th>
               <th>Nivel</th>
               <th>Obs.</th>
               <th>Editar</th>
               <th>Eliminar</th>
             </thead>
             <tbody>
              @if($gimnasta->count())  
              @foreach($gimnasta as $gimnastas)  
              <tr>
                <td>{{$gimnastas->apellido}}</td>
                <td>{{$gimnastas->nombre}}</td>
                <td>{{$gimnastas->club}}</td>
                <td>{{$gimnastas->categoria}}</td>
                <td>{{$gimnastas->nivel}}</td>
                <td>{{$gimnastas->observaciones}}</td>
                <td><a class="btn btn-primary btn-xs" href="{{action('GimnastasController@edit', $gimnastas->id)}}" ><span class="fas fa-user-edit"></span></a></td>
                <td>

                <form action="{{action('GimnastasController@destroy', $gimnastas->id)}}" method="post">
                   {{csrf_field()}}
                   <input name="_method" type="hidden" value="DELETE">

                   <button class="btn btn-danger btn-xs" type="submit"><span class="far fa-trash-alt"></span></button> 
                 </form>
                 </td> 
               </tr>
               @endforeach 
               @else
               <tr>
                <td colspan="8">No hay registro !!</td>
              </tr>
              @endif
            </tbody>

          </table>
        </div>

                      <a href="{{ route('gimnastas.create') }}" class="btn btn-info" >Añadir Gimnasta</a>
                      <a href="{{ route('gimnastas.import') }}" class="btn btn-info" >Importar Listado</a>

      </div>






      {{ $gimnasta->links() }}


</section>

@endsection
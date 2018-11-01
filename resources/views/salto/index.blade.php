@extends('layouts.app')
@section('content')
<div class="container-fluid">

<!-- <div class="jumbotron">
  <div class="container">
    <h1 class="display-10">Fluid jumbotron</h1>
  </div>
</div> -->

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">

        <img src="{{url('/images/salto.png')}}" class="rounded float-right" width="100" height="100">

        <h1 class="card-title">Listado Salto</h1>

        {{ Form::open(['route' => 'salto', 'method' => 'GET', 'class' => 'form-inline pull-right'])}}

                    <div class="col">
                    <select class="custom-select mr-sm-2" name="numero_rotacion" id="numero_rotacion">
                         <option selected>Rotación</option>
                         @foreach($arraygrupos as $valor)     
                        <option value="{{$valor}}">Grupo {{$valor}}</option>
                         @endforeach
                         </select> 
              </div>
              <div class="col">
                <button type="submit" class="btn btn-primary">Seleccionar
                </button>
              </div>

        {{ Form::close() }} 

      </div>
    </div>
  </div>

</div> 


<div class="row">
  <div class="col-sm-12">
    <div class="card">


                <div class="invisible">
			    <input type="text" name="id_aparato" id="id_aparato" class="input-sm" value="1"> </div>

    	<div class="table-responsive">


            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Apellido</th>
               <th>Nombre</th>
               <th>Club</th>
                <th>Nivel</th>
                <th>Categoría</th>
               <th>Seleccionar</th>
               <th>Editar</th>
               <th>Puntaje</th>
             </thead>
             <tbody>

              @if($gimnasta->count())  


              @foreach($gimnasta as $gimnastas)  

              <tr>
                <td>{{$gimnastas->apellido}}</td>
                <td>{{$gimnastas->nombre}}</td>
                <td>{{$gimnastas->club}}</td>
                <td>{{$gimnastas->nivel}}</td>
                <td>{{$gimnastas->categoria}}</td>
                <td>

                <form action="{{action('PuntajeController@select', $gimnastas->id)}}" method="post">
                  {{csrf_field()}}

                  @if($gimnastas->puntos!=null)
                   <button class="btn btn-secondary btn-xs" disabled><span class="far fa-check-circle"></span>

                   @else
                 <button class="btn btn-success btn-xs" type="submit"><span class="far fa-check-circle"></span></button> 
                    @endif
  
                </td>


         </form>


                <td>
                @if($gimnastas->puntos!=null)
                <a class="btn btn-primary btn-xs" href="{{action('SaltoController@edit', $gimnastas->id)}}" target="_blank" onClick="window.open(this.href, this.target,'width=300,height=600'); return false;"><span class="fas fa-user-edit"></span></a>
                @else
                @endif
                </td>


                </td>
                
                <td>{{$gimnastas->puntos}}</td>

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
 
    </div>
  </div>





</div>


@endsection
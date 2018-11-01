@extends('layouts.app')
@section('content')
<div class="container">

<!-- <div class="jumbotron">
  <div class="container">
    <h1 class="display-10">Fluid jumbotron</h1>
  </div>
</div> -->

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">

         <img src="/images/barras.png" class="rounded float-right" width="100" height="100">

        <h1 class="card-title">Listado Barras</h1>

        {{ Form::open(['route' => 'barras', 'method' => 'GET', 'class' => 'form-inline pull-right'])}}

                    <div class="col">
                    <select class="custom-select mr-sm-2" name="numero_rotacion" id="numero_rotacion">
                      <option selected>Rotación</option>
                          <option value="1">Grupo 1</option>
                          <option value="2">Grupo 2</option>
                          <option value="3">Grupo 3</option>
                          <option value="4">Grupo 4</option>
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
			    <input type="text" name="id_aparato" id="id_aparato" class="input-sm" value="4"> </div>

    	<div class="table-container">


            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Apellido</th>
               <th>Nombre</th>
               <th>Club</th>
               <th>Seleccionar</th>
               <th>Puntaje</th>
             </thead>
             <tbody>

              @if($gimnasta->count())  
              @foreach($gimnasta as $gimnastas)  
              <tr>
                <td>{{$gimnastas->apellido}}</td>
                <td>{{$gimnastas->nombre}}</td>
                <td>{{$gimnastas->club}}</td>
                <td>

                <form action="{{action('PuntajeController@select', $gimnastas->id)}}" method="post">
                  {{csrf_field()}}

                <!-- <input name="_method" type="hidden" value="DELETE"> -->

                  @if($gimnastas->puntos!=null)
                   <button class="btn btn-secondary btn-xs" disabled><span class="far fa-check-circle"></span></button> 
                   @else
                 <button class="btn btn-primary btn-xs" type="submit"><span class="far fa-check-circle"></span></button> 
                    @endif
   
		<!-- acá iba el </form> de abajo antes de agregar el <td> que contiene el "invisible -->
    

                </td>

         </form>

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
 <!--     <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
          <ul class="list-group list-group-flush">
    <li class="list-group-item">Cras justo odio</li>
    <li class="list-group-item">Dapibus ac facilisis in</li>
    <li class="list-group-item">Vestibulum at eros</li>
  </ul>
      </div> -->
    </div>
  </div>

 <!--   <div class="col-sm-6">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
</div> -->




</div>


@endsection
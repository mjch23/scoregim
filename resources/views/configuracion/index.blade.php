@extends('layouts.app')
@section('content')

 <div class="card">
        <div class="card-body">

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Grupos</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Puntajes</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Niveles</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
 
   {{ Form::open(['route' => 'configuracion', 'method' => 'GET', 'class' => 'form-inline pull-right'])}} 

  <div class="form-inline">  

  <div class="form-group mb-2">

          <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Cantidad de Grupos">
    </div>
    
    <div class="form-group mx-sm-3 mb-2">

    <input type="number" class="form-control" id="cantidad_grupos" name="cantidad_grupos" placeholder="Cantidad">
  </div>


  <button type="submit" class="btn btn-primary mb-2">Seleccionar</button>

     <div class="form-group mx-sm-3 mb-2">

              <input class="alert alert-warning" name="configuracion_actual" id="configuracion_actual" value="{{$conf_actual->cantidad_grupos}}" readonly> -->  Configuración Actual

    </div>
 
</div>

 {{ Form::close() }} 

  </div>

  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
   
   {{ Form::open(['route' => 'configuracion', 'method' => 'GET', 'class' => 'form-inline pull-right'])}} 

  <div class="form-group mb-2">

          <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Puntaje Máximo">
    </div>
    
    <div class="form-group mx-sm-3 mb-2">

    <input type="number" class="form-control" id="puntaje_maximo" name="puntaje_maximo" placeholder="Puntaje">
  </div>


  <button type="submit" class="btn btn-primary mb-2">Seleccionar</button>

     <div class="form-group mx-sm-3 mb-2">

              <input class="alert alert-warning" name="configuracion_actual" id="configuracion_actual" value="{{$conf_actual->puntaje_maximo}}" readonly> -->  Configuración Actual

    </div>
 
 {{ Form::close() }} 

  </div>



  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
  	
      {{ Form::open(['route' => 'configuracion', 'method' => 'POST', 'class' => 'form-inline pull-right'])}}


            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Id</th>
               <th>Nivel</th>
               <th>Selección</th>
             </thead>
             <tbody>

              @if($nivel->count())  
              @foreach($nivel as $niveles)  

              <tr>
                <td>{{$niveles->id_nivel}}</td>
                <td>{{$niveles->descripcion_nivel}}</td>

                <td>
                  <input class="form-check-input" type="checkbox" name="niveles[]" value="{{$niveles->id_nivel}}" id="checkbox_id_nivel"></td>

               </tr>



               @endforeach 
               @else
               <tr>
                <td colspan="8">No hay registro !!</td>
              </tr>
              @endif
            </tbody>



          </table>

               <div class="col">
                <button type="submit" class="btn btn-primary float-right">Seleccionar
                </button>
                <input class="alert alert-warning" name="configuracion_actual" id="configuracion_actual" value="{{$conf_actual->id_nivel1}} - {{$conf_actual->id_nivel2}} - {{$conf_actual->id_nivel3}} - {{$conf_actual->id_nivel4}}" readonly> -->  Configuración Actual
              </div>

      {{ Form::close() }} 




  </div>
</div>

</div>
</div>



@endsection
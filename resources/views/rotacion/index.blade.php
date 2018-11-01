@extends('layouts.app')
@section('content')

  <section class="content">

      <div class="card">
        <div class="card-body">
                    <h3 class="card-title">Lista Gimnastas</h3>
<form>
    <div class="form-row"> 

          <h4>
              Búsqueda de Gimnastas</h4>
              {{ Form::open(['route' => 'rotacion', 'method' => 'GET', 'class' => 'form-inline pull-right'])}}
              <div class="col">
                {{ Form::text('nivel', null, ['class' => 'form-control', 'placeholder' => 'Nivel'])}}
              </div>
              <div class="col">
                {{ Form::text('club', null, ['class' => 'form-control', 'placeholder' => 'Club'])}}
              </div>
              <div class="col">
                {{ Form::text('categoria', null, ['class' => 'form-control', 'placeholder' => 'Categoria'])}}
              </div>
              <div class="col">
                <button type="submit" class="btn btn-primary">Seleccionar
                </button>
              </div>

             {{ Form::close() }}

<!-- Acá estaba el formulario completo de selección de Rotación -->

            </div>

</form>

  <!--            <form>
                <div class="form-row">
                      <div class="col">
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                      <option selected>Nivel</option>
                    </select>
                  </div>
                      <div class="col">
      <input type="text" class="form-control" placeholder="First name">
                  </div>
                  <div class="col">
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                      <option selected>Categoría</option>
                    </select>
                  </div>
                      <div class="col">
                    <button type="submit" class="btn btn-primary">Seleccionar</button>
                  </div>
                </div>
              </form> -->



          <div class="table-container">


              {{ Form::open(['route' => 'rotacion', 'method' => 'POST', 'class' => 'form-inline pull-right'])}}


    <div class="form-row"> 

              <div class="col">
                    <select class="custom-select mr-sm-2" name="numero_rotacion" id="numero_rotacion">
                 <!--     <option selected>Rotación</option>
                          <option value="1">Grupo 1</option>
                          <option value="2">Grupo 2</option>
                          <option value="3">Grupo 3</option>
                          <option value="4">Grupo 4</option>
                    </select> -->


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

     </div>

          <!-- Revisar si no conviene mater este formulario dentro de la parte que maneja los checkboxes porque no está mandando nada al array-->

            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Apellido</th>
               <th>Nombre</th>
               <th>Club</th>
               <th>Categoría</th>
               <th>Nivel</th>
               <th>Obs.</th> 
               <th>Selección</th>
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

                <td>
                  <input class="form-check-input" type="checkbox" name="id_gimnasta[]" value="{{$gimnastas->id}}" id="checkbox_id_gimnasta"></td>

               </tr>

               @endforeach 
               @else
               <tr>
                <td colspan="8">No hay registro !!</td>
              </tr>
              @endif
            </tbody>

          </table>



      {{ Form::close() }} 


        </div>

      </div>

</div>





      {{ $gimnasta->links() }}


</section>

@endsection
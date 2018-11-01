@extends('layouts.app')
@section('content')

<section class="content">

   <div class="card">
        <div class="card-body">

                    <h3 class="card-title">Resultados Finales</h3>

  <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="totales-tab" data-toggle="tab" href="#totales" role="tab" aria-controls="totales" aria-selected="true">Totales</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="equipos-tab" data-toggle="tab" href="#equipos" role="tab" aria-controls="equipos" aria-selected="false">Equipos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="suelo-tab" data-toggle="tab" href="#salto" role="tab" aria-controls="salto" aria-selected="false">Salto</a>
  </li>  
  <li class="nav-item">
    <a class="nav-link" id="suelo-tab" data-toggle="tab" href="#suelo" role="tab" aria-controls="suelo" aria-selected="false">Suelo</a>
  </li>
    <li class="nav-item">
    <a class="nav-link" id="viga-tab" data-toggle="tab" href="#viga" role="tab" aria-controls="viga" aria-selected="false">Viga</a>
  </li>
    <li class="nav-item">
    <a class="nav-link" id="barras-tab" data-toggle="tab" href="#barras" role="tab" aria-controls="barras" aria-selected="false">Barras</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="totales" role="tabpanel" aria-labelledby="home-tab">


    
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Apellido</th>
               <th>Nombre</th>
               <th>Club</th>
               <th>Nivel</th>
               <th>Categoria</th>
               <th>Salto</th>
               <th>Suelo</th>
               <th>Viga</th>
               <th>Barras</th>
               <th>Total</th>               
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
                <td>{{$gimnastas->puntos_salto}}</td>
                <td>{{$gimnastas->puntos_suelo}}</td>
                <td>{{$gimnastas->puntos_viga}}</td>
                <td>{{$gimnastas->puntos_barras}}</td>
                <td>{{$gimnastas->puntos_totales}}</td>   
        
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
  <div class="tab-pane fade" id="equipos" role="tabpanel" aria-labelledby="profile-tab">
       

       <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Apellido</th>
               <th>Nombre</th>
               <th>Club</th>
               <th>Categoría</th>     
               <th>Nivel</th>  
               <th>Puntos Totales</th>                  
               <th>Ranking</th>                    
              </thead>
             <tbody>

              @if($porequipos->count())  
              @foreach($porequipos as $item)  
              
              <tr>
                <td>{{$item->apellido}}</td>
                <td>{{$item->nombre}}</td>
                <td>{{$item->club}}</td>
                <td>{{$item->categoria}}</td>      
                <td>{{$item->nivel}}</td>   
                <td>{{$item->puntos_totales}}</td> 
                <td>{{$item->rana}}</td>  
               </tr>
               @endforeach 

               <tr>
                <td colspan="8">No hay registro !!</td>
              </tr>
              @endif

            </tbody>

          </table>  



  </div>
    <div class="tab-pane fade" id="salto" role="tabpanel" aria-labelledby="profile-tab">
    
       <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Apellido</th>
               <th>Nombre</th>
               <th>Club</th>
               <th>Salto</th>         
              </thead>
             <tbody>

              @if($gimnasta->count())  
              @foreach($gimnasta as $gimnastas)  
              <tr>
                <td>{{$gimnastas->apellido}}</td>
                <td>{{$gimnastas->nombre}}</td>
                <td>{{$gimnastas->club}}</td>
                <td>{{$gimnastas->puntos_salto}}</td>             
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
  <div class="tab-pane fade" id="suelo" role="tabpanel" aria-labelledby="profile-tab">
    
       <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Apellido</th>
               <th>Nombre</th>
               <th>Club</th>
               <th>Suelo</th>         
              </thead>
             <tbody>

              @if($gimnasta->count())  
              @foreach($gimnasta as $gimnastas)  
              <tr>
                <td>{{$gimnastas->apellido}}</td>
                <td>{{$gimnastas->nombre}}</td>
                <td>{{$gimnastas->club}}</td>
                <td>{{$gimnastas->puntos_suelo}}</td>             
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
  <div class="tab-pane fade" id="viga" role="tabpanel" aria-labelledby="profile-tab">
    
       <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Apellido</th>
               <th>Nombre</th>
               <th>Club</th>
               <th>Viga</th>         
              </thead>
             <tbody>

              @if($gimnasta->count())  
              @foreach($gimnasta as $gimnastas)  
              <tr>
                <td>{{$gimnastas->apellido}}</td>
                <td>{{$gimnastas->nombre}}</td>
                <td>{{$gimnastas->club}}</td>
                <td>{{$gimnastas->puntos_viga}}</td>             
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
  <div class="tab-pane fade" id="barras" role="tabpanel" aria-labelledby="profile-tab">
    
       <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Apellido</th>
               <th>Nombre</th>
               <th>Club</th>
               <th>Barras</th>         
              </thead>
             <tbody>

              @if($gimnasta->count())  
              @foreach($gimnasta as $gimnastas)  
              <tr>
                <td>{{$gimnastas->apellido}}</td>
                <td>{{$gimnastas->nombre}}</td>
                <td>{{$gimnastas->club}}</td>
                <td>{{$gimnastas->puntos_barras}}</td>             
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

</section>


@endsection
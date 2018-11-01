@extends('layouts.app')
@section('content')

<section class="content">

  <script>
  function validarSiNumero(numero){
    if (isNaN(numero)|| numero<0 || numero>{{$puntaje_maximo->puntaje_maximo}})
    $("#alertaModal").modal();

  }
</script>


      <form class="needs-validation" action="{{action('PuntajeController@store')}}" method="POST">
    {{csrf_field()}}


<div class="container">

    <div class="jumbotron">



  @foreach($gimnasta as $gimnastas)  
  <!--    <img src="/images/SiluetaFotoScoreGim.png" class="rounded float-right" width="200" height="200"> -->
    <h2 class="display-10">Gimnasta: {{$gimnastas->apellido}} {{$gimnastas->nombre}}</h2>
    <h2 class="display-10">Club: {{$gimnastas->club}} </h2>
    <div class="invisible">
    <input type="text" name="id" id="id" class="form-control input-sm" value="{{$gimnastas->id}}"> </div>



  @endforeach



    </div>



  <div class="card">
  <h1 class="card-header">Calificar Aparato</h1>

              <div class="card-body">
                <div class="form-group row">
    <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Calificación</label>
                  <div class="col-sm-10">
      <input type="number" step="0.01" min="0" class="form-control form-control-lg" id="puntos_aparato" name="puntos_aparato" placeholder="Puntaje" onChange="validarSiNumero(this.value);" required>
            <div class="invalid-feedback">
        Por favor ingresar un Puntaje
      </div>

                  </div>
                </div>
                      <div>




    <button type="submit" class="btn btn-success btn-lg btn-block">Confirmar</button>




                      </div>
                  </div>
                </div>


{{ $gimnasta->links() }}

              </div>
  </div>

    </form>


<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

</section>


<!-- Modal -->
<div class="modal fade" id="alertaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle text-danger"></i>    Alerta</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Valor erróneo ingresado. No pueden ser letras y debe estar entre 0 y {{$puntaje_maximo->puntaje_maximo}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

@endsection
@extends('layouts.app')
@section('content')

<section class="content">

 <script>
  function validarSiNumero(numero){
    if (isNaN(numero)|| numero<0 || numero>{{$puntaje_maximo->puntaje_maximo}})
    $("#alertaModal").modal();
    location.reload();


  }
</script>

			@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Error!</strong> Revise los campos obligatorios.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			@if(Session::has('success'))
			<div class="alert alert-info">
				{{Session::get('success')}}
			</div>
			@endif 

	<div class="card">
				<div class="card-header">
					<h5 class="card-title">Editar Puntaje</h5>
				</div>
				<div class="card-body">			

@if($gimnastas->count())
@foreach($gimnastas as $gimnasta)		

						<form method="POST" action="{{ route('salto.update',$gimnasta->id, $gimnasta->puntos) }}"  role="form">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="PATCH">


								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" readonly class="form-control-plaintext" name="apellido" id="apellido" class="form-control input-sm" value="{{$gimnasta->apellido}}">
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" readonly class="form-control-plaintext" name="nombre" id="nombre" class="form-control input-sm" value="{{$gimnasta->nombre}}">
									</div>

							</div>

						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="text" readonly class="form-control-plaintext" name="club" id="club" class="form-control input-sm"  value="{{$gimnasta->club}}">
							</div>
						</div>

						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="number" step="0.01"  min="0" name="puntos" id="puntos" class="form-control input-sm" onChange="validarSiNumero(this.value);" value="{{$gimnasta->puntos}}" required>
							</div>
						</div>

							<div class="col-xs-6 col-sm-6 col-md-6">
									<input type="submit"  value="Actualizar" class="btn btn-success btn-block">
								</div>	
@endforeach
@endif	
						</form>
					</div>

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
@extends('layouts.app')
@section('content')

	<section class="content">

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
					<h5 class="card-title">Nueva Gimnasta</h5>
				</div>
				<div class="card-body">					
	
						<form method="POST" action="{{ route('gimnastas.store') }}"  role="form">
							{{ csrf_field() }}

								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="dni" id="dni" class="form-control input-sm" placeholder="DNI">
									</div>
								</div>

								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="apellido" id="apellido" class="form-control input-sm" placeholder="Apellido">
									</div>
								</div>



							<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="nombre" id="nombre" class="form-control input-sm" placeholder="Nombre">
									</div>
							</div>

							<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="club" id="club" class="form-control input-sm" placeholder="Club">
									</div>
							</div>

							<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="categoria" id="categoria" class="form-control input-sm" placeholder="Categoria">
									</div>
							</div>

							<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="nivel" id="nivel" class="form-control input-sm" placeholder="Nivel">
									</div>
							</div>

							<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="edad" id="edad" class="form-control input-sm" placeholder="Edad">
									</div>
							</div>

							<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<textarea type="text" name="observaciones" id="observaciones" class="form-control input-sm" placeholder="Observaciones"></textarea>
									</div>
							</div>

				<!--			<div class="form-group">
								<textarea name="club" class="form-control input-sm" placeholder="Resumen"></textarea>
							</div>
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="club" id="edicion" class="form-control input-sm" placeholder="Edición del gimnastas">
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="precio" id="precio" class="form-control input-sm" placeholder="Precio del gimnastas">
									</div>
								</div>
							</div>
							<div class="form-group">
								<textarea name="autor" class="form-control input-sm" placeholder="Autor"></textarea>
							</div>
							<div class="row"> -->

								<div class="col-xs-6 col-sm-6 col-md-6">
									<input type="submit"  value="Guardar" class="btn btn-success btn-block">
									<a href="{{ route('gimnastas.index') }}" class="btn btn-info btn-block" >Atrás</a>
								</div>	

		
						</form>
					</div>
				</div>


	</section>
	@endsection
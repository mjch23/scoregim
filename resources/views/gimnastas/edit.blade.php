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
					<h5 class="card-title">Editar Gimnasta</h5>
				</div>
				<div class="card-body">					

						<form method="POST" action="{{ route('gimnastas.update',$gimnastas->id) }}"  role="form">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="PATCH">


								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="apellido" id="apellido" class="form-control input-sm" value="{{$gimnastas->apellido}}">
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="nombre" id="nombre" class="form-control input-sm" value="{{$gimnastas->nombre}}">
									</div>

							</div>

						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="text" name="club" id="club" class="form-control input-sm"  value="{{$gimnastas->club}}">
							</div>
						</div>

								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="categoria" id="categoria" class="form-control input-sm" value="{{$gimnastas->categoria}}">
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="nivel" id="nivel" class="form-control input-sm" value="{{$gimnastas->nivel}}">
									</div>
								</div>
						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="text" name="edad" id="edad" class="form-control input-sm" value="{{$gimnastas->edad}}">
							</div>
						</div>


								<div class="col-xs-6 col-sm-6 col-md-6">
									<input type="submit"  value="Actualizar" class="btn btn-success btn-block">
									<a href="{{ route('gimnastas.index') }}" class="btn btn-info btn-block" >Atrás</a>
								</div>	

						</form>
					</div>




	</section>
	@endsection
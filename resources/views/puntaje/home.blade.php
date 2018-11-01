@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mensaje</div>

                <div class="card-body">

                    <h3><i class="fas fa-check-circle text-success" ></i>    Calificación registrada correctamente</h3>

                    @if($id_aparato==1)
                    <a type="button" class="nav-link" href="{{ route('salto.index')}}"> Continuar Calificando</a>
                    @endif
                    @if($id_aparato==2)
                    <a type="button" class="nav-link" href="{{ route('suelo.index')}}"> Continuar Calificando</a>
                    @endif
                    @if($id_aparato==3)
                    <a type="button" class="nav-link" href="{{ route('viga.index')}}"> Continuar Calificando</a>
                    @endif
                    @if($id_aparato==4)
                    <a type="button" class="nav-link" href="{{ route('barras.index')}}"> Continuar Calificando</a>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
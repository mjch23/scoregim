@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mensaje</div>

                <div class="card-body">
<!--

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

-->

                    @if(Auth::user()->hasRole('admin'))
                        <div><h5>Accediste como Administrador</h5></div>
                    @else
                        <div><hs>Accediste como Usuario</hs></div>
                    @endif
                    
                    <h5> <i class="fas fa-check-circle text-success" ></i>      Acceso Correcto </h5>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mensaje</div>

                <div class="card-body">

                    <h3><i class="fas fa-check-circle text-success" ></i>    Calificación editada correctamente</h3>

                    <input name="button" class="btn btn-secondary btn-lg" type="button" onclick="window.close();" value="Cerrar esta ventana" />               
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
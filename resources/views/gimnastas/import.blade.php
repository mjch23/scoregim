   
@extends('layouts.app')
@section('content')



<div class="card">

	  <div class="card-header">
  	    <h5 class="card-title">Importar Listado de Excel</h5>
  </div>
  <div class="card-body">


	<section class="content">


                    <form method="post" action="{{url('import-excel')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="file" name="excel">
                        <br><br>
                        <input type="submit" value="Importar Archivo" class="btn btn-primary" style="padding: 10px 20px;">
                        
                    </form>


     </section>

       </div>
</div>

@endsection
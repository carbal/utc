@extends('layouts.admon')

@section('script')
@parent
@stop

@section('style')
@parent
@stop

@section('contenedor')
	<div class="col-md-6 col-md-offset-3">
		<legend>Lista de Talleres</legend>
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<th>CLAVE</th>
					<th>TALLER</th>	
					<th>ACCIONES</th>				
				</tr>
			@foreach($talleres as $taller)
				<tr>
					<td>{{$taller->id_taller}}</td>
					<td>{{$taller->taller}}</td>					
					<td><a>Editar</a></td>					
				</tr>
			@endforeach
			</table>
			<a href="{{URL::to('talleres/new')}}" class="btn btn-lg btn-success pull-right">Nuevo</a>
		</div>
	</div>
@stop
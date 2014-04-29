@extends('layouts.admon')

@section('script')
	@parent	
@stop

@section('style')
	@parent
@stop

@section('contenedor')
	<div class="col-md-8 col-md-offset-2">
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<th>CLAVE</th>
					<th>ASIGNATURA</th>
					<th>ACCIONES</th>
				</tr>
			@foreach($asignaturas as $asignatura)
				<tr>
					<td>{{$asignatura->id}}</td>
					<td>{{$asignatura->asignatura}}</td>
					<td><a>Editar</a></td>
				</tr>
			@endforeach
			</table>
		</div>
		<div class="text-center">
			{{$asignaturas->links()}}			
		</div>		
		<a href="{{URL::to('asignatura/new')}}" class="btn btn-lg btn-success pull-right">Nuevo</a>
	</div>
@stop
@extends('layouts.admon')

@section('script')
	@parent	
@stop

@section('style')
	@parent
@stop

@section('contenedor')
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-primary">
			  <div class="panel-heading">
					<h3 class="panel-title">LISTA DE ASIGNATURAS.</h3>
			  </div>
			<table class="table table-condensed">
				<tr>
					<th>CLAVE</th>
					<th>ASIGNATURA</th>
					<th style="text-align:center;">ACCIONES</th>
				</tr>
				@foreach($asignaturas as $asignatura)
					<tr>
						<td>{{$asignatura->id}}</td>
						<td>{{$asignatura->asignatura}}</td>
						<td style="text-align:center;"><span class="glyphicon glyphicon-pencil" onclick="editar()"></span></td>
					</tr>
				@endforeach
			</table>
		</div>
		<div class="text-center">{{$asignaturas->links()}}</div>		
	</div>
@stop
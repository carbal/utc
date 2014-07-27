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
					<h3 class="panel-title">LISTA DE CARRERAS.</h3>
			  </div>
			<table class="table table-condensed">
				<tr>
					<th>CLAVE</th>
					<th>CARRERA</th>
					<th>GRUPO</th>
					<th style="text-align:center;">ACCIONES</th>
				</tr>

				@foreach($carreras as $carrera)
					<tr>
						<td>{{$carrera->id}}</td>
						<td>{{$carrera->carrera}}</td>
						<td>{{$carrera->grupo}}</td>
						<td style="text-align:center;"><span class="glyphicon glyphicon-pencil" onclick="editar({{$carrera->id}})"></span></td>
					</tr>
				@endforeach
			</table>
		</div>
		<div class="text-center">{{$carreras->links()}}</div>
	</div>
@stop
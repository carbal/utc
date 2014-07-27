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
				<h3 class="panel-title">PROFESORES.</h3>
		  </div>
		<table class="table table-condensed">
			<tr>
				<th>PROFESOR</th>
				<th>USER</th>
				<th>CONTRASEÑA</th>
				<th>NIVEL</th>
				<th>Acciones</th>
			</tr>
			@foreach($profesores as $profesor)
			<tr>
				<td>{{$profesor->nombre." ".$profesor->apellido}}</td>				
				<td>{{$profesor->nick}}</td>
				<td>{{$profesor->password}}</td>
				<td>{{$profesor->tipo}}</td>
				<td style="text-align:center;"><span class="glyphicon glyphicon-pencil" onclick="editar({{$profesor->id}})"></span></td>
			</tr>
			@endforeach
		</table>
	</div>
		<div class="text-center">{{$profesores->links()}}</div>
</div>
@stop
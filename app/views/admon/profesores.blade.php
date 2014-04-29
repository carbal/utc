@extends('layouts.admon')

@section('script')
@parent
@stop

@section('style')
@parent
@stop

@section('contenedor')
<div class="col-md-8 col-md-offset-2">
	<legend>Lista de profesores</legend>
	<br>	
	<div class="table-responsive">
		<table class="table table-bordered">
			<tr>
				<th>PROFESOR</th>
				<th>USER</th>
				<th>CONTRASEÑA</th>
				<th>NIVEL</th>
				<th colspan="2">Acciones</th>
			</tr>
			@foreach($profesores as $profesor)
			<tr>
				<td>{{$profesor->nombre." ".$profesor->apellido}}</td>				
				<td>{{$profesor->nick}}</td>
				<td>{{$profesor->password}}</td>
				<td>{{$profesor->tipo}}</td>
				<td><a id="{{$profesor->id}}">Baja</a></td>
				<td><a id="{{$profesor->id}}">Editar</a></td>
			</tr>
			@endforeach
		</table>
		<div class="text-center">{{$profesores->links()}}</div>
		
		<a href="{{URL::to('profesor/new')}}" class="btn btn-success btn-lg pull-right">Nuevo</a>

	</div>
</div>
@stop
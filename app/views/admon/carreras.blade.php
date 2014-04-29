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
					<th>CARRERA</th>
					<th>GRUPO</th>
					<th>ACCIONES</th>
				</tr>

				@foreach($carreras as $carrera)
					<tr>
						<td>{{$carrera->id}}</td>
						<td>{{$carrera->carrera}}</td>
						<td>{{$carrera->grupo}}</td>
						<td><a id="{{$carrera->id}}">Editar</a></td>
					</tr>
				@endforeach
			</table>
			<div class="text-center">{{$carreras->links()}}</div>
			<a class="btn btn-lg btn-success pull-right">Nuevo</a>
		</div>
	</div>
@stop
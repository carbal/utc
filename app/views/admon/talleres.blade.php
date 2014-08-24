@extends('layouts.admon')

@section('script')
@parent
@stop

@section('style')
@parent
@stop

@section('contenedor')
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-primary">
		  <div class="panel-heading">
				<h3 class="panel-title">LISTA DE TALLERES</h3>
		  </div>
		<table class="table table-condensed">
			<tr>
				<th>CLAVE</th>
				<th>TALLER</th>	
				<th style="text-align:center;">ACCIONES</th>				
			</tr>
			@foreach($talleres as $taller)
				<tr>
					<td>{{$taller->id}}</td>
					<td>{{$taller->taller}}</td>					
					<td style="text-align:center;"><span class="glyphicon glyphicon-pencil" onclick="editar({{$taller->id}})"></span></td>
				</tr>
			@endforeach
		</table>
		</div>
			<a href="{{URL::to('talleres/new')}}" class="btn btn-lg btn-success pull-right">Nuevo</a>
	</div>
@stop
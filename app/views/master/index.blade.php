@extends('layouts.master')

@section('script')
@parent
@stop


@section('style')
@parent
@stop

@section('contenedor')
<div class="col-md-8 col-md-offset-2">
	
	
	<div class="alert alert-success">
		<p><strong>Bienvenido profesor: </strong><span class="label label-success">{{Session::get('usuario')}}</span></p>
		<p><strong>Fecha :  </strong>{{date('d-m-Y')}}</p>		
	</div>
	<div class="alert alert-info">
		<span class="label label-info">Notificaciones: 0</span>
	</div>
</div>
@stop
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
		<h1>Bienvenido :{{Session::get('usuario')}}</h1>
		<p><strong>Fecha :  </strong>{{date('d-m-Y')}}</p>		
	</div>
	<div class="alert alert-info">
		<span class="label label-info">Notificaciones: 0</span>
	</div>
</div>
@stop
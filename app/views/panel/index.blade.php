@extends('layouts.panel')

@section('script')
@parent
@stop

@section('style')
@parent
<style type="text/css">
	div#jumbotron{
		min-height: 500px;
		font-family: sans-serif;

	}
</style>
@stop

@section('contenedor')
 <div class="jumbotron text-center col-sm-10 col-md-10 col-lg-10 col-md-offset-1" id="jumbotron">
 	<div class="alert alert-danger" style="display:none">
 		<h4>Errores</h4>
 	</div>
 	<h1>Sistema de Reservaciones &nbsp<small>Universidad Tecnológico del Centro</small></h1> 
 	{{date("d/m/Y")}}
 	<br>	
 	<br>
 	<br>
 	<a href="reservar" class="btn btn-success btn-lg" title="Reservar una sala">Reservar salon</a>
 	
 </div>
@stop
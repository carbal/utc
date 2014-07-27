@extends('layouts.panel');

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
 	
	 	<h1>Bitácora de Acceso a Laboratorios y Talleres </h1> 
	 	<h2>Universidad Tecnológica del Centro</h2>
	 	<p>{{date("d/m/Y")}}</p>	
	 	<br>	
	 	<br>
	 	<br>
	 	<a href="#" class="btn btn-success btn-lg">IT-UTC-RHU-08</a>
 	
 	</div>
@stop
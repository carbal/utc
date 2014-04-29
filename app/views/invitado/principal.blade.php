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
	<div class="jumbotron" id="jumbotron">
		 <div class="jumbotron text-center col-sm-10 col-md-10 col-lg-10 col-md-offset-1" id="jumbotron">
 	
 	<h1>Sistema de Reservaciones &nbsp<small>Universidad Tecnológica del Centro</small></h1> 
 	{{date("d/m/Y")}}	
 	<br>	
 	<br>
 	<br>
 	<a href="#" class="btn btn-success btn-lg">Bienvenido</a>
 	
 </div>
	</div>
@stop
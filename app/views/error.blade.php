@extends('layouts.panel')

@section('script')
	@parent	
@stop

@section('style')
	@parent
@stop

@section('contenedor')
	<div class="alert alert-danger col-md-8 col-md-offset-2">
		<h5 class="text-center">Ha ocurrido un error, por favor notifique al administrador.</h5>
	</div>
@stop
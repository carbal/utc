@extends('layouts.master')

@section('script')
@parent
@stop


@section('style')
@parent
@stop

@section('contenedor')
<div class="col-md-8 col-md-offset-2">
	<div class="alert alert-warning" >
		<span class="label label-info">Usted no ha hecho una resevación</span>
	</div>
</div>
@stop
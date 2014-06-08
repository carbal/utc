@extends('layouts.master')

@section('script')
	@parent	
@stop

@section('style')
	@parent
@stop

@section('contenedor')
	<div class="alert alert-success">
		{{$id}}
	</div>
@stop
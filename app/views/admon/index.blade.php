@extends('layouts.admon')

@section('script')
	@parent	
@stop

@section('style')
	@parent
@stop

@section('contenedor')
<h2 class="label label-info">Administrador : {{Session::get('usuario')}}</h2>
@stop
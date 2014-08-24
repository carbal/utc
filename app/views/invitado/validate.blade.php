@extends('layouts.panel')

@section('script')
	@parent
	{{HTML::script('js/validate.js')}}
	<script type="text/javascript">
	$(function(){
		$('#formValidate').validate();
	})
	</script>
@stop

@section('style')
	@parent
	<style>
		div.required{
			position: absolute;
			top: 6px;
			margin-left: 14px;
			color: crimson;
			text-align: center;
		}
	</style>
@stop

@section('contenedor')

<div class="col-md-10">
	<form id="formValidate"  method="POST" class="form-horizontal" role="form">
		<div class="form-group">
			<label for="" class="control-label col-md-5">Required</label>
			<div class="col-md-5"><input type="text" class="form-control required"></div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-md-5">Integer</label>
			<div class="col-md-5"><input type="text" class="form-control integer"></div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-md-5">Caracteres</label>
			<div class="col-md-5"><input type="text" class="form-control required"></div>
		</div>
		<div class="form-group">
			<input class="btn btn-sm bt-primary" type="submit" value="subir">
		</div>
			
	</form>
</div>
@stop


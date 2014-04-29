@extends('layouts.admon')

@section('script')
	@parent	
@stop

@section('style')
	@parent
@stop

@section('contenedor')
<div class="col-md-8 col-md-offset-2">
	<legend>Profesor Nuevo</legend>
	<form action="add" method="post" class="form form-horizontal">
		<div class="form-group">
			<label for="" class="label-control col-md-2">Nombre</label>
			<div class="col-md-5"><input name="Profesor" type="text" class="form-control"></div>
		</div>		
		<div class="form-group">
			<label for="" class="label-control col-md-2">Usuario</label>
			<div class="col-md-5"><input name="user" type="text" class="form-control"></div>
		</div>
		<div class="form-group">
			<label for="" class="label-control col-md-2">Contraseña</label>
			<div class="col-md-5"><input name="pass" type="password" class="form-control"></div>
		</div>
		<div class="form-group">
			<label for="" class="label-control col-md-2">Confirmar</label>
			<div class="col-md-5"><input name="confirmar" type="password" class="form-control"></div>
		</div>
		<div class="form-group">
			<div class="col-md-2">
				<input type="submit" class="form-control btn btn-info" value="Guardar">				
			</div>
		</div>
	</form>
</div>
@stop
@extends('layouts.panel')

@section('script')
@parent
@stop

@section('style')
@parent
@stop

@section('contenedor')

<div class="row">
	<legend>Bitacora de talleres</legend>
	<div class="col-md-6">
		<form action="" class="form form-horizontal">
			<div class="form-group">
				<label for="" class="control-label col-md-3">Taller :</label>
				<div class="col-md-6">
					<select name="taller" id="" class="form-control">
						<option value="" selected>Elegir taller</option>
						@foreach($talleres as $taller)
						<option value="{{$taller->id_taller}}">{{$taller->taller}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-md-3">Fecha :</label>
				<div class="col-md-6"><input type="date" class="form-control"></div>
			</div>			
			<div class="form-group">
			<a href="" class="btn btn-lg btn-success">Buscar</a>			
			</div>
		</form>
	</div>
	
	<div class="col-md-6">
		<div class="alert alert-info">
			<ul>
				<li>Llege el formulario para realizar la busqueda</li>
			</ul>
		</div>
		<table class="table table-bordered">
			<tr>
				<th>HORARIO</th>
				<th>ESTADO</th>
				<th>MAESTRO</th>				
				<th>MATERIA</th>
			</tr>
			<tr>
				<td>sub</td>
				<td>sub</td>
				<td>sub</td>
				<td></td>				
			</tr>
		</table>
	</div>
</div>		
@stop

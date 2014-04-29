@extends('layouts.master')

@section('script')
@parent
@stop

@section('style')
@parent
<style type="text/css">
	.error{
	background-color: #BC1010;
    font-weight: bold;
	float: right;
	z-index: 100;		
	color: white;
	letter-spacing: 2px;
	line-height: 1em;
	border-radius: 5px;
	padding: 3px;
}
</style>
@stop

@section('contenedor')
	<div class="row">
		<div class="col-md-6">
			<form action="" class="form-horizontal">
			<br>
			<br>			
			<legend>Reservar Salon</legend>
			<br>
			<div class="form-group">
				<label for="" class="col-md-4 control-label">Salón :</label>
				<div class="col-md-8" style="overflow:hidden; display:inline-block;">
					<select class="form-control required" name="id_taller">
						<option value="">Elegir taller</option>
						@foreach($talleres as $taller)
						<option value="{{$taller->id_taller}}">{{$taller->taller}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-md-4">Fecha :</label>
				<div class="col-md-8" style="overflow:hidden;">
					<input type="date" class="form-control required date" value="">
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-md-4 control-label">Horario :</label>
				<div class="col-md-8">
					<select class="form-control required" name="hora" id="hora" size="2" multiple>
						<option value="" selected>Elegir Horario</option>
						@foreach($horarios as $horario)
						<option value="{{$horario->id}}">{{$horario->horario}}</option>
						@endforeach						
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-md-4 control-label">Carrera :</label>
				<div class="col-md-8">
					<select class="form-control required" name="id_carrera" id="id_carrera">
						<option value="" selected>Elegir Carrera</option>
						@foreach($carreras as $carrera)
						<option value="{{$carrera->id_carrera}}">{{$carrera->carrera}}</option>
						@endforeach						
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-md-4 control-label">Materia :</label>
				<div class="col-md-8">
					<select class="form-control required" name="id_asig" id="id_asig">
						<option id="static" value="" selected>Elegir Materia</option>
						@foreach($asignaturas as $asig)
							<option value="{{$asig->id_asig}}" id="{{$asig->id_asig}}" style="display:none;">{{$asig->asignatura}}</option>
						@endforeach										
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-md-4 control-label">Objetivo:</label>
				<div class="col-md-8"><input type="text" class="form-control required"></div>
			</div>
			<div class="form-group">
				<label for="" class="col-md-4 control-label">Descripción :</label>
				<div class="col-md-8">
					<textarea name="" id="" cols="30" rows="10" class="form-control required"></textarea>
				</div>
			</div>
			<div class="form-group text-right">
				<input class="btn btn-primary btn-lg required" type="submit" value="Reservar">
			</div>
		</form>	
		</div>
		<div class="col-md-6">
			<br>			
			<div class="alert alert-info">
				<ul>
					<li>Todos los campos deben de estar llenos</li>
					<li>Las salas solo pueden ser prestadas por 2 horas</li>
				</ul>
			</div>
			<div id="disponible">
				<table class="table table-bordered">
					<tr>
						<th>Horario</th>
						<th></th>
						<th></th>
						<th>Horario</th>
					</tr>
				</table>
			</div>
		</div>
	</div>

	{{HTML::script('js/validate.js')}}
		
@stop

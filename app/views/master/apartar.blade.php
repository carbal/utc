@extends('layouts.master')

@section('script')
@parent
@stop

@section('style')
@parent
@stop

@section('contenedor')
<div class="col-md-10 col-md-offset-1">

	<form action="" class="form-horizontal">
		<div class="form-group">
				<label for="" class="col-md-2 control-label">Salón :</label>
				<div class="col-md-4">
					<select class="form-control required" name="id_taller">
						<option value="">Elegir taller</option>
						@foreach($talleres as $taller)
						<option value="{{$taller->id_taller}}">{{$taller->taller}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-md-2">Fecha :</label>
				<div class="col-md-4">
					<input type="date" class="form-control required" value="">
				</div>
			</div>		
			<input type="hidden" name="id_horario"value="default">
			<input type="submit" class="btn btn-lg btn-success" value="Siguiente">
	</form>
	
	<legend>Disponibilidad de Horario</legend>
	<table class="table table-bordered">
		<tr>
			<th>Horario</th>
			<th colspan="2">Accion</th>			
		</tr>
	</table>
</div>
{{HTML::script('js/validate.js')}}
<script type="text/javascript">
	$(function(){

	})
</script>

@stop

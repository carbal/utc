@extends('layouts.master')

@section('script')
@parent
@stop

@section('style')
@parent
<script type="text/javascript">
	function infoReserva(idReserva){

	$('#modalInfo').modal();		
	$.ajax({
		url: "{{URL::to('reserva/inforeserva')}}",
		type: 'POST',
		dataType: 'json',
		data: {
			id: idReserva
		}
	})
	.done(function(json) {
		if(json.success){
			$('#modalInfo').html(json.html);
			$('#modalInfo').modal();
		}else{
			alert('Hubo un error, por favor notifique al administrador');
		}
	})
	.fail(function(json) {
		console.log(json);
	});
	
}
</script>
@stop


@section('contenedor')

	<div class="col-md-10 col-md-offset-1">
		
		<div class="panel panel-primary">
			<div class="panel-heading">
			   <h4>Mis Reservas :{{Session::get('usuario')}}</h4>				
			</div>
			<div class="panel-body">
				<table class="table table-condensed table-hover">
					<tr>
					 	<th>Carrera</th>
						<th>Grupo</th>
						<th>Asignatura</th>
						<th>Taller</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Estado</th>
						<th colspan="2">Acciones</th>
					</tr>
					@foreach($reservas as $reserva)
					<tr>
						<td>{{$reserva->carrera}}</td>
						<td>{{$reserva->grupo}}</td>
						<td>{{$reserva->asignatura}}</td>
						<td>{{$reserva->taller}}</td>
						<td>{{$reserva->fecha}}</td>
						<td>{{$reserva->hora}}</td>
						@if($reserva->estado==0)
						<td><span class="label label-warning">Sin Aprobar</span></td>
						@else
						<td><span class="label label-success">Aprobado</span></td>
						@endif
						<td><span class="glyphicon glyphicon-pencil" title="Editar" style="cursor:pointer"></span></td>
						<td><span class="glyphicon glyphicon-search" title="Información" style="cursor:pointer" onclick="infoReserva({{$reserva->id}})"></span></td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>

	<!--MODAL infoReserva()-->	
	<div class="modal fade" id="modalInfo">		
	</div><!-- /.modal -->

@stop
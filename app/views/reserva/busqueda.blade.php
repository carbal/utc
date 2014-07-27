@if(sizeof($reservas) > 0)
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-primary">
			<div class="panel-heading">
			   <h4>Reservas :{{Session::get('usuario')}}</h4>				
			</div>
				<table class="table table-condensed table-hover">
					<tr>
					 	<th>Carrera</th>
						<th>Grupo</th>
						<th>Asignatura</th>
						<th>Taller</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Estado</th>
						<th colspan="3">Acciones</th>
					</tr>
					@foreach($reservas as $reserva)
					<tr>
						<td>{{$reserva->carrera}}</td>
						<td>{{$reserva->grupo}}</td>
						<td>{{$reserva->asignatura}}</td>
						<td>{{$reserva->taller}}</td>
						<td>{{$reserva->fecha}}</td>
						<td>{{$reserva->hora}}</td>
						@if($reserva->estado == 0)
						<td><span class="label label-warning">No Aprodado</span></td>
						@elseif($reserva->estado == 1)
						<td><span class="label label-success">Aprobado</span></td>
						@elseif($reserva->estado == 2)
						<td><span class="label label-danger">Cancelado</span></td>
						@endif
						<td><span class="glyphicon glyphicon-search" title="Información" onclick="infoReserva({{$reserva->id}})"></span></td>
						<td><a href="{{URL::to('profesor/reservar')}}/{{$reserva->id}}" target="_blank"><span class="glyphicon glyphicon-pencil" title="Editar"></span></a></td>
						@if($reserva->estado == 2)
						<td><span class="glyphicon glyphicon-ban-circle" title="Cancelar"></span></td>
						@else
						<td><span class="glyphicon glyphicon-ban-circle" title="Cancelar" onclick="modalCancelar({{$reserva->id}})"></span></td>
						@endif
					</tr>
					@endforeach
				</table>
		</div>
	</div>
@else
	<div class="alert alert-warning col-md-8 col-md-offset-2">
		<h5>No se encontraron resultados.</h5>
	</div>
@endif
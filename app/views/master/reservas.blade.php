@extends('layouts.master')

@section('script')
	@parent
	{{HTML::script('js/jquery-ui.js')}}
<script type="text/javascript">
	$(function(){
		$('#fecha').datepicker();
		$('#fecha2').datepicker();
		$('#hasta').on('click',function(){
			$('#fecha').datepicker('show');
		});
		$('#apartir').on('click',function(){
			$('#fecha2').datepicker('show');
		});
	});
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

@section('style')
	@parent
	{{HTML::style('css/jquery-ui.css')}}

@stop

@stop


@section('contenedor')
<div class="row" style="height:5em;">
	<div class="col-md-10 col-md-offset-1">
		<form action="" method="POST" class="form-inline pull-right" role="form">
			<button type="button" class="btn btn-primary btn-sm pull-right">
				<span class="glyphicon glyphicon-search"></span>
			</button>

			<div class="input-group input-group-sm col-md-3 pull-right">
				<input name="fecha" type="text" class="form-control" id="fecha" placeholder="hasta" readonly/>				
				<span class="input-group-btn">
					<button type="button" class="btn btn-primary" id="hasta">
						<span class="glyphicon glyphicon-calendar"></span>						
					</button>
				</span>
			</div>

			<div class="input-group input-group-sm col-md-3 pull-right">
				<input name="fecha" type="text" class="form-control" id="fecha2" placeholder="apartir" readonly/>			
				<span class="input-group-btn">
					<button type="button" class="btn btn-primary" id="apartir">
						<span class="glyphicon glyphicon-calendar"></span>						
					</button>
				</span>
			</div>

		</form>		
	</div>
</div>
<div class="row">	
	<div class="col-md-10 col-md-offset-1">
		
		<div class="panel panel-primary">
			<div class="panel-heading">
			   <h4>Reservas :{{Session::get('usuario')}}</h4>				
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
						@if($reserva->estado==0)
						<td><span class="label label-warning">Sin Aprobar</span></td>
						@else
						<td><span class="label label-success">Aprobado</span></td>
						@endif
						<td><span class="glyphicon glyphicon-search" title="Información" onclick="infoReserva({{$reserva->id}})"></span></td>
						<td><a href="{{URL::to('profesor/reservar')}}/{{$reserva->id}}" target="_blank"><span class="glyphicon glyphicon-pencil" title="Editar"></span></a></td>
						<td><span class="glyphicon glyphicon-ban-circle" title="Cancelar" onclick="reserva.cancelar({{$reserva->id}})"></span></td>
					</tr>
					@endforeach
				</table>
				<div class="text-center">
					{{$reservas->links()}}
				</div>  
			</div>
		</div>
	</div>
</div>
	<!--MODAL infoReserva()-->	
	<div class="modal fade" id="modalInfo">		
	</div><!-- /.modal -->
@stop
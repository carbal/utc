@extends('layouts.master')

@section('script')
	@parent
<script type="text/javascript">

	var idCancelar = null;

	$(function(){
		$.datepicker.regional['es'] = {
	            closeText: 'Cerrar',
	            prevText: 'Ant',
	            nextText: 'Sig',
	            currentText: 'Hoy',
	            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
	            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
	            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
	            'Jul','Ago','Sep','Oct','Nov','Dic'],
	            dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
	            dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
	            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
	            weekHeader: 'Sm',
	            dateFormat: 'yy/mm/dd',	            
	            firstDay: 1,
	            isRTL: false,
	            showMonthAfterYear: false,
	            yearSuffix: ''
	        };
	      $.datepicker.setDefaults($.datepicker.regional['es']);
		
		
		$('#fecha').datepicker();
		$('#fecha2').datepicker();
		$('#hasta').on('click',function(){
			$('#fecha2').datepicker('show');
		});
		$('#apartir').on('click',function(){
			$('#fecha').datepicker('show');
		});
	});
	function infoReserva(idReserva){

		$('#modalInfo').modal();		
		$.ajax({
			url: "{{URL::to('reserva/info')}}",
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
	function modalCancelar(id){
		idCancelar = id; //asignamos la id para cancelar
		$('#modalCancelar').modal();
	}


	function cancelarReserva(idReserva){
		$.ajax({
			url: '{{URL::to("reserva/cancelar")}}',
			type: 'POST',
			dataType: 'json',
			data: {id:idCancelar},
		})
		.done(function(json) {
			idCancelar = null;
			if(json.success){
				$('#modalCancelar').hide();
				window.location.reload();
			}else{
				$('#modalCancelar .modal-body').html('<h5>Ha ocurrido un error, por favor notifique al administrador!!!.</h5>')
			}

		})
		.fail(function(json) {
			idCancelar =  null;
			console.log(json);
		});
	}

	function busqueda(){
		var _fecha  = $('#fecha').prop('value');
		var _fecha2 = $('#fecha2').prop('value');
		if(_fecha == '')
			return;

		$.ajax({
			url: '{{URL::to("reserva/busqueda")}}',
			type: 'POST',
			dataType: 'json',
			data: {fecha: _fecha,fecha2:_fecha2}
		})
		.done(function(json) {
			if(json.success){
				$('#errorReserva').slideUp('slow');
				$('#reservasContainer').html(json.html);
			}else{
				$('#errorReserva').slideDown('slow');
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
@stop

@section('contenedor')
<div class="row" style="height:5em;">
	<div class="col-md-10 col-md-offset-1">
		<form action="" method="POST" class="form-inline pull-right" role="form">
			<button type="button" class="btn btn-primary btn-sm pull-right" onclick="busqueda()">
				<span class="glyphicon glyphicon-search"></span>
			</button>

			<div class="input-group input-group-sm col-md-3 pull-right">
				<input name="fecha" type="text" class="form-control" id="fecha2" placeholder="hasta" readonly/>				
				<span class="input-group-btn">
					<button type="button" class="btn btn-primary" id="hasta">
						<span class="glyphicon glyphicon-calendar"></span>						
					</button>
				</span>
			</div>

			<div class="input-group input-group-sm col-md-3 pull-right">
				<input name="fecha" type="text" class="form-control" id="fecha" placeholder="apartir" readonly/>			
				<span class="input-group-btn">
					<button type="button" class="btn btn-primary" id="apartir">
						<span class="glyphicon glyphicon-calendar"></span>						
					</button>
				</span>
			</div>

		</form>		
	</div>
</div>
<div class="row" id="reservasContainer">	
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
				<div class="text-center">
					{{$reservas->links()}}
				</div>  
	</div>
</div>
	<!--MODAL infoReserva()-->	
	<div class="modal fade" id="modalInfo">		
	</div><!-- /.modal -->

	<div class="modal fade" id="modalCancelar">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">DESEA CANCELAR LA RESEVA?</h4>
				</div>
				<div class="modal-body">
					<button type="button" class="btn btn-primary" onclick="cancelarReserva()">Cancelar</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
@stop
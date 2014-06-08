@extends('layouts.panel')

@section('script')
@parent
{{HTML::script('js/jquery-ui.js')}}
@stop

@section('style')
@parent
{{HTML::style('css/jquery-ui.css')}}
@stop

@section('contenedor')
<div class="row">
	<legend>Bitacora de talleres</legend>
	<div class="col-md-6">
		<form action="" class="form form-horizontal">
			<div class="form-group">
				<label for="" class="control-label col-md-3">Taller :</label>
				<div class="col-md-6">
					<select name="taller" id="id_taller" class="form-control">
						<option value="" selected>Elegir taller</option>
						@foreach($talleres as $taller)
						<option value="{{$taller->id}}">{{$taller->taller}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-md-3">Fecha :</label>
				<div class="col-md-6"><input type="text" class="form-control" id="fecha"></div>
			</div>			
			<div class="form-group">
				<div class="col-md-offset-3 col-md-6 pull-right">
					<button type="button" class="btn btn-success" onclick="buscar()">Buscar</button>
				</div>
			</div>
		</form>
	</div>
	
		<div class="col-md-4 col-md-offset-1" id="horarios" style="display:none;">
	<legend>Horarios Disponibles</legend>

	<table class="table table-condensed">
		<tr>
			<th>Horario</th>
			<th>Estado</th>
			<th colspan="2">Reservar</th>			
		</tr>
		@foreach($horarios as $horario)
		<tr class="success">
			<td>{{$horario->horario}}</td>
			<td><span class="label label-success" id="{{$horario->id}}">Disponible</span></td>
			<td><input type="checkbox" id="{{$horario->id}}" value="{{$horario->id}}" name="reservar[]"></td>
			<td></td>
		</tr>
		@endforeach
	</table>	
</div>
</div>		
<script type="text/javascript">
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
	//activamos datepicker
	$('#fecha').datepicker();


	function buscar(){
		var _taller = $('#id_taller').prop('value');
		var _fecha  = $('#fecha').prop('value');
		console.log(_taller+"  "+_fecha);
		if(_taller == '' || _fecha == ''){
			alert('llege los datos para realizar busqueda');
			return;
		}
		
		$('input:checkbox').prop('disabled',true);
		$.ajax({
			url: "{{URL::to('reserva/getfecha')}}",
			type: 'POST',
			dataType: 'json',
			data: {
				taller: _taller,
				fecha : _fecha
			}
		})
		.done(function(data) {
			console.log(data);
			if(data.length>0){
	  			//variable del estado de la reserva 0: reservado sin aprobar 1: reservado aprobado
	  			$('div#horarios').hide('slow',function(){
	  				$(this).show('slow');
	  			});
	  			for( clave in data){  		      				
					$('span[id='+data[clave].id_horario+"]").removeClass('label-success').addClass('label-warning');
					$('span[id='+data[clave].id_horario+"]").html('Reservado');
					$('span[id='+data[clave].id_horario+"]").parents('tr').removeClass('success').addClass('warning');
					$('input[id='+data[clave].id_horario+"]:checkbox").prop('checked',true);
	 			}
	  		}else{
	  			$('div#horarios').hide('slow',function(){
	  				$(this).show('slow');
	  			});  			
	  		}
		})
		.fail(function(data) {
			console.log(data);
		});
		
	}
</script>
@stop

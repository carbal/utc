@extends('layouts.panel')

@section('script')
	@parent
	<script type="text/javascript">
		$(document).on('ready', function() {
			$('[name="fecha"]').datepicker();
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
			$('button#reservas').on('click', function(){

				if($('[name="fecha"]').prop('value') == '' || $('[name="taller"]').prop('value') == '')
					return;

				$.ajax({
					url: '{{URL::to("horario/reservas")}}',
					type: 'POST',
					data: $('form#reservas').serialize()
				})
				.done(function(data) {
					$('#container').html(data);
				})
				.fail(function() {
					console.log("error");
				});
				
			});
		});

	</script>
@stop

@section('style')
	@parent
	{{HTML::style('css/jquery-ui.css')}}
@stop

@section('contenedor')
	<section class="col-md-8 col-md-offset-2">
		<form action="" id="reservas" method="POST" class="form-inline" role="form">
			<div class="form-group">
				<input name="fecha" type="text" class="form-control" id="" placeholder="fecha...">
			</div>
			<div class="form-group">
				<select name="taller" class="form-control">
					<option value="">Elegir taller</option>
					@foreach($talleres as $taller)
						<option value="{{$taller->id}}">{{$taller->taller}}</option>
					@endforeach
				</select>
			</div>
			<button type="button" id="reservas" class="btn btn-primary">Buscar</button>
		</form>
		<br>
		<br>
		<div id="container">
			<div class="panel panel-primary">
			  <div class="panel-heading">
					<h3 class="panel-title">Detalle de horario por taller.</h3>
			  </div>
			  <div class="panel-body">
			  	<p>Llene los campos para obtener la información correspondiente.</p>
			  </div>
			  <table class="table table-condensed">
			  	<tr>
			  		<th>HORARIO</th>
			  		<th>PROFESOR</th>
			  		<th>DESCRIPCIÓN</th>
			  	</tr>
			  </table>
			</div>
		</div>
	</section>
@stop
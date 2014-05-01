@extends('layouts.master')

@section('script')
@parent
{{HTML::script('js/jquery-ui.js')}}
@stop

@section('style')
@parent
{{HTML::style('css/jquery-ui.css')}}
<style type="text/css">
	.error{
	float: right;
	font-family: inherit;
	color: crimson;
	font-size: smaller;
	z-index: 1000;
	font-weight: bolder;
}
</style>
@stop

@section('contenedor')
<div class="row">
	
<div class="col-md-6">
	<legend>Verificar Disponibilidad</legend>
	<form action="" class="form form-horizontal">
		<div class="form-group">
			<label for="" class="control-label col-md-4">Taller :</label>
			<div class="col-md-5">
				<select name="id_taller" id="id_taller" class="form-control required">
					<option value="" selected>Elegir Taller</option>
					@foreach($talleres as $taller)
						<option value="{{$taller->id}}">{{$taller->taller}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-md-4">Fecha :</label>
			<div class="col-md-5">
				<input name="fecha" type="text" class="form-control required" id="fecha">				
			</div>
				<input type="button" class="btn btn-sm btn-success" id="disponible" value="??">
		</div>	
		<div class="form-group">
			<label for="" class="control-label col-md-4">Carrera :</label>
			<div class="col-md-5">
				<select name="id_carrera" class="form-control" id="id_carrera">
					<option value="" selected>Elegir Carrera</option>
					@foreach($carreras as $carrera)
						<option value="{{$carrera->id}}">{{$carrera->carrera}}</option>
					@endforeach
				</select>						
			</div>
		</div>			
		<div class="form-group">
			<label for="" class="control-label col-md-4">Asignatura :</label>
			<div class="col-md-5">
				<select name="id_asig" class="form-control" id="id_asig">
					<option value="" selected>Elegir Asignatura</option>
					@foreach($asignaturas as $asignatura)
						<option value="{{$asignatura->id}}" id="{{$asignatura->id}}"style="display:none;">{{$asignatura->asignatura}}</option>
					@endforeach
				</select>				
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
			<td><input type="checkbox" id="{{$horario->id}}" value="{{$horario->id}}" name="reservar[]" data-toggle="tooltip" data-placement="right" title="Hora desfasada"></td>
			<td></td>
		</tr>
		@endforeach
	</table>
	<div class="pull-right">		
		<button class="btn btn-sm btn-primary" id="reiniciar">Reiniciar</button>
		<button class="btn btn-sm btn-success" id="enviar">Reservar</button>		
	</div>
</div>
</div>
<section class="row" id="sectionObj" style="display:none; margin-top:2em;">
	<div class="col-md-8 col-md-offset-2">		
	<article class="alert alert-danger">
		<p>Para completar  debe agregar minimo un objetivo, sino su reserva será cancenlada</p>
	</article>
	<div class="responsive" id="misobjetivos">
		<table class="table table-bordered">			
			<tr>
				<th>Objetivo</th>
				<th>Descripción</th>
				<th coslspan="2">Acciones</th>				
			</tr>				
			<tr>
				<td colspan="4">
					<a class="btn btn-sm btn-primary pull-right" onclick="$('div#modalObjetivos').modal('show');">+Objetivo</a>
				</td>								
			</tr>
		</table>
	</div>
	</div>
</div>

<!--SECCION DE MODALES-->
<!--DIV PARA  MENSAJES MODAL JQUERYUI-->
<article id="modal-msj" style="display:none;"></article>
<!--MODAL PARA GUARDAR OBJETIVOS-->
<div class="modal fade" id="modalObjetivos">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Agregar Objetivos a la reserva</h3>
  </div>
  <div class="modal-body">
    <form id="objetivos" action="" class="form form-horizontal">
    	<div class="form-group">
    		<label for="" class="control-label col-md-3">Objetivo:</label>
    		<div class="col-md-8">
    			<input type="text" class="form-control" name="objetivo" id="objetivo" required>
    		</div>
    	</div>
    	<div class="form-group">
    		<label for="" class="control-label col-md-3">Descripcion:</label>
    		<div class="col-md-8">
    			<textarea type="text" cols="40" rows="10" class="form-control" name="descripcion" id="descripcion" required>
    			</textarea>
    		</div>
    	</div>
  </div>
  <div class="modal-footer">
    <input type="button"  class="btn btn-md btn-primary" value="Guardar" onclick="insertObjetivo()" id="insertObj"/>
    <input type="button" class="btn btn-md btn-primary" value="Actualizar" style="display:none;" id="updateObj" onclick="updateObjetivo()"/>  
    </form>
  </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--SECCION DE INPUT HIIDDEN-->
<input type="hidden" id="idUpdate" value="">



<!--SECCION JS-->

<script type="text/javascript">
	//VARIABLES GLOBALEs almacena id_materia->sus id_asig
	var asig={{json_encode($asig)}};
	//variables globales de inputs necesarios para insertar en la DB
	var _taller,_fecha,_carrera,_asig,_horario;
	//horas que reservará el profesor
	var horas=0;

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
	            beforeShowDay:$.datepicker.noWeekends,
	            minDate:'-0D',
	            maxDate:'2W',
	            firstDay: 1,
	            isRTL: false,
	            showMonthAfterYear: false,
	            yearSuffix: ''
	        };
	      $.datepicker.setDefaults($.datepicker.regional['es']);

	      $('input#fecha').datepicker();

	      //EVENTO CARRRERA->ASIGNATURA CORRESPONDIENTE

	      $('select#id_carrera').on('change', function(){
	      		
	      		var idCarrera=$(this).prop('value');

	      		var asignaturas=asig[idCarrera];     		

	      		//ocultamos todos los hijos de select de asignaturas
	      		$('select#id_asig').children().css('display','none');
	      		$('select#id_asig').children().first().attr('selected',true);;
	      		for(clave in asignaturas){
	      			//desocultamos solos los options correspondientes
	      			$('select#id_asig option#'+clave).css('display','block');
	      		}
	      	
	      });

			//datos popover
		
	      //ajax
	      $('input#disponible').on('click', function() {
	      		//asignamos valor a las globales siguientes
	      		_taller=$('select#id_taller').prop('value');
	      		_fecha=$('input#fecha').prop('value');

	      	if(_taller != '' && _fecha !=''){
	      		$.ajax({
  		      		url: "{{URL::to('profesor/reservafecha')}}",
  		      		type: 'POST',
  		      		dataType:'json',
  		      		data:{
  		      			taller:_taller,
  		      			fecha:_fecha
  		      		}	      		      		
	      		})
	      		.done(function(data){	      			
  		      		if(data.length>0){
  		      			//variable del estado de la reserva 0: reservado sin aprobar 1: reservado aprobado
  		      			$('div#horarios').hide('slow',function(){
  		      				$(this).show('slow');
  		      			});
  		      			//es estado siempre es el mismo pero se repite en cada fila del objeto data
  		      			var edoReserva= data[0].estado;
  		      			for( clave in data){  		      				
  		      				$('input:checkbox[id='+data[clave].id_horario+']').prop('disabled',true);  		      				
	      					$('span[id='+data[clave].id_horario+"]").removeClass('label-success').addClass('label-warning');
	      					$('span[id='+data[clave].id_horario+"]").html('Reservado');
	      					$('span[id='+data[clave].id_horario+"]").parents('tr').removeClass('success').addClass('warning');
	      	 			}
  		      		}else{
  		      			$('div#horarios').hide('slow',function(){
  		      				$(this).show('slow');
  		      			});
  		      			$('input:checkbox').prop({
  		      				disabled:false,
  		      				checked:false
  		      			});
  		      			$('span.label').removeClass('label-warning').addClass('label-success');  		      			
  		      			$('span.label').parents('tr').removeClass('warning').addClass('success');
  		      		}
	      		})
	      		.fail(function() {
	      		    console.log("Controllador:Master, accion: getReservaFecha");
	      		});
	      	}else{  		
	      		//activamos modal con msj de error
	      		$('article#modal-msj').dialog({
	      			modal: true,
	      			height:100,
	      			show:{effect:'fade',duration:800}, //blind,bounce,clip,drop,explode, fold,fade,highlight,pulsate,puff,scale,size,shake,slide,transfer			
	      			duration:5000,
	      			width:300,
	      			title:'Mensaje de error',
	      			open:function(){
	      				$(this).html('<span>Los campos Taller y Fecha son requeridos</span>');
	      			}				    
	      		});
	      	}	  

	      });


	
	var horario=[];
	//evitar que se seleccionen checkbox desafasados
	$('input[type=checkbox]').on('click',function(event){
		var checked=$('input:checkbox:checked');		
		var actual=$(this).prop('value');		

		if(horario.length==0){
			horario.push(actual);
			//console.log('uno');			
		}					
		else if(actual - horario[horario.length-1] == 1){
			//console.log(actual+"-"+horario[horario.length-1]+' =1');
			horario.push(actual);
		}
		else if(actual-horario[horario.length-1]>=2){
			$(this).parents('tr').removeClass('success').addClass('danger').delay(800).addClass('success');
			event.preventDefault();
			//console.log(actual+"-"+horario[horario.length-1]+' >=2');
		}
		else if(actual - horario[horario.length-1]<0){
			$(this).parents('tr').removeClass('success').addClass('danger').delay(800).addClass('success');
			event.preventDefault();
			//console.log(actual+"-"+horario[horario.length-1]+' <0');
		}
		else if(actual - horario[horario.length-1]==0){
			$(this).parents('tr').removeClass('success').addClass('danger').delay(800).addClass('success');
			event.preventDefault();
			//console.log(actual+"-"+horario[horario.length-1]+' =0');
		}
		else if(actual >= horario[0] && actual <= horario[horario.length-1]){
			$(this).parents('tr').removeClass('success').addClass('danger').delay(800).addClass('success');
			event.preventDefault();
			//console.log('intervalo');
		}	
		
	})//TERMINA EVENTO CLIKC



//MANDER RESERVA A BASE DE DATOS
	$('button#enviar').on('click',function(){
		//asignamos valores a las variables globales
		_carrera = $('select#id_carrera').prop('value');
		_asig    = $('select#id_asig').prop('value');
		_horario = $('input:checkbox:checked');
		horas    = _horario.length;
		
		//console.log("carrera :"+_carrera +" asig: "+_asig+" fecha: "+_fecha+" taller: "+ typeof(_taller));
		if(_taller!='' && _fecha!='' && _carrera!='' && _asig!='' && _horario.length>0){
			$.ajax({
				url: "{{URL::to('profesor/insertreserva')}}",
				type: 'POST',
				dataType:'json',
				data:{
					id_taller :_taller,
					fecha     :_fecha,
					id_carrera:_carrera,
					id_asig   :_asig,
					jsonhoras:JSON.stringify(horario)
				}
			})
			.done(function(json) {

				if(json.success){
					$('article#objetivos').dialog({
						modal:true,
						title:'Describas las actividades que realizará',
						show:{effect:'fade',duration:800},
						width:500,
						height:300,
						open:function(){
							$(this).html('<span>Su reservacion ha finalizado con exito</span>');
						}
					});

					//mostramos la tabla de objetivos
					$('#sectionObj').slideDown('slow');
					//bloquemos los botones para evitar nuevas inserciones
					$('#enviar,#reiniciar').prop('disabled',true);
					$('input:checkbox').prop('disabled',true);
				}else{
					$('article#modal-msj').dialog({
						modal:true,
						title:'Mensaje de error',
						show:{effect:'fade',duration:800},
						width:500,
						height:300,
						open:function(){
							$(this).html('<span>Por favor comuniquese con el administrador</span>');
						}
					});
				}
			})
			.fail(function() {
				alert('FATAL ERROR: CONTROLLER:MASTER, ACTION:INSERTRESERVA');
			});		

		}else{
			$('article#modal-msj').dialog({
	      			modal: true,
	      			height:100,
	      			show:{effect:'fade',duration:800}, //blind,bounce,clip,drop,explode, fold,fade,highlight,pulsate,puff,scale,size,shake,slide,transfer      			
	      			width:300,
	      			title:'Mensaje de error',
	      			open:function(){
	      				$(this).html('<span>Los campos son obligatorios</span>');
	      			}				    
	      		});
		}
	});
	
	//evento reiniciar
	$('button#reiniciar').on('click',function(){
		$('input:checkbox').prop('checked',false);
		horario=[];
	});


	
//evento para actualiaar objetivo
$('#editarObj').on('click', function() {
	$.ajax({
		url: "{{URL::to('objetivo/update')}}",
		type: 'POST',
		dataType: 'json',
		data:$('form#objetivos').serialize()
	})
	.done(function() {
		if(data.success){
			alert('La actulizacion a finalizado con éxito')
		}else{
			alert('Error al actualizar');
		}
	})
	.fail(function(data) {
		console.log(data);
	});
	
});//termina evento click


});//termina jquery

//funcion parar guardar el objetivo
function insertObjetivo(){

	$.ajax({
			url: "{{URL::to('objetivo/insert')}}",
			type: 'POST',
			dataType: 'json',
			data:$('form#objetivos').serialize()
		})
		.done(function(json) {
			
			if(json.success){
				$('#modalObjetivos').modal('hide');
				$('div#misobjetivos').html(json.html);
				$('form#objetivos').each(function(){
					this.reset();
				})				
			}
			
		})
		.fail(function(json) {
			console.log('FATAL ERROR: CONTROLLER:MASTERCONTROLLER ACTION:OBJETIVO');
		});
}
//funcion para eliminar objetivo
function deleteObjetivo(obj){
	if(confirm('Desea eliminar este objetivo?')){
		$.ajax({
			url: "{{URL::to('objetivo/delete')}}",
			type: 'POST',
			dataType:'json',			
			data:'id='+obj
		})
		.done(function(json) {
			if(json.success){
				$('tr[id='+obj+']').slideUp('slow');							
			}
		})
		.fail(function() {
			console.log("FATAL ERROR: CONTROLLER:OBJETIVO ,ACTION:ELIMINAR");
		});		
	}
}

//funcion mostrar el modal objetivo
function modalUpdate(obj){
var datos = $('tr#'+obj).find('td');
//asigmanos los datos
$('input#objetivo').prop('value',datos.eq(0).html());
$('textarea#descripcion').html(datos.eq(1).html());
//agregamos el valor al input hidden necesario para hacer update
$('body #idUpdate').prop('value',obj);
//mostramos  el modal y boton update
$('div#modalObjetivos').modal('show');
$('#modalObjetivos input#updateObj').show();
$('#modalObjetivos input#insertObj').hide();
}

//funcion para actualizar objetivo
function updateObjetivo(){

	$.ajax({
		url: "{{URL::to('objetivo/update')}}",
		type: 'POST',
		dataType: 'json',
		data:$('form#objetivos').serialize()+'&id='+$('input#idUpdate').prop('value')
	})
	.done(function(json) {
		if(json.success){
			$('#modalObjetivos').modal('hide');
			$('form#objetivos').each(function() {
				this.reset();
			});
		}
	})
	.fail(function(json) {
		console.log(json);
	});
	
}
</script>
@stop

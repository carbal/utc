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
@if($carreras != NULL)
<div class="col-md-10 col-md-offset-1 alert alert-info" id="info" style="display:none;">
	<div style="overflow:hidden;">		
		<span class="glyphicon glyphicon-info-sign" style="float:left; margin-right:.5em;"></span> <p>Si desea modificar los horarios comuniquese con el administrador</p>
	</div>
</div>

<div class="alert alert-success col-md-offset-1 col-md-10" style="display:none;" id="successUpdate">
	<p>La reserva se ha actualizado con exito</p>
</div>
<div class="col-md-6">

	@if(isset($reserva))
	<legend>Modificar Reserva :</legend>
	@else
	<legend>Nueva Reserva :</legend>
	@endif
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

			<div class="input-group col-md-5">
					<input name="fecha" type="text" class="form-control required" id="fecha"/>				
				<span class="input-group-btn">
					<button type="button" class="btn btn-success" id="disponible">
						<span class="glyphicon glyphicon-search"></span>						
					</button>
				</span>
			</div>
		
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
		<div class="form-group" id="areaUpdate" style="display:none;">
			<div class="col-md-offset-4 col-md-5">
				<button class="btn btn-primary pull-right" type="button" onclick="updateReserva()">Actualizar</button>				
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
	<div class="pull-right">		
		<button class="btn btn-sm btn-primary" id="reiniciar">Reiniciar</button>
		<button class="btn btn-sm btn-success" id="enviar">Reservar</button>		
	</div>
</div>
@else
	<div class="alert alert-danger col-md-8 col-md-offset-2">
		<h5>Usted no tiene asignado ninguna carrera, por favor notifique al administrador.</h5>
	</div>
@endif
</div>
<section class="row" id="sectionObj" style="display:none; margin-top:2em;">
	<div class="col-md-8 col-md-offset-2">		
	<article class="alert alert-danger">
		<p>Para completar  debe agregar minimo un objetivo, si no su reserva será cancelada</p>
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
</section>

<!--SECCION DE MODALES-->
<!--DIV PARA  MENSAJES MODAL JQUERYUI-->
<article id="modal-msj" style="display:none;"></article>
<!--MODAL PARA GUARDAR OBJETIVOS-->
<div class="modal fade" id="modalObjetivos">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Agregar Objetivos :</h3>
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
<input type="hidden" id="id_reserva" value="">

<!--SECCION JS-->

<script type="text/javascript">
	//VARIABLES GLOBALEs almacena id_materia->sus id_asig
	var asig={{json_encode($asig)}};
	//variables globales de inputs necesarios para insertar en la DB
	var _taller,_fecha,_carrera,_asig,_horario;
	//horas que reservará el profesor
	var horas=0;
	var xd ="{{URL::to('objetivo')}}";
	
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
	      $('button#disponible').on('click', function() {
	      		//asignamos valor a las globales siguientes
	      		_taller=$('select#id_taller').prop('value');
	      		_fecha=$('input#fecha').prop('value');

	      	if(_taller != '' && _fecha !=''){
	      		$.ajax({
  		      		url: "{{URL::to('reserva/getfecha')}}",
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
  		      			$('span.label').html('Disponible');
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
				url: "{{URL::to('reserva/insert')}}",
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
		
		if(confirm('Si reinicia sus datos se perderan, desea continuar?')){
		//eliminar reserva, eliminar horarios y objetivos
			location.reload();
		}
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
			alert('La actualizacion a finalizado con éxito')
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
			data:$('form#objetivos').serialize()+'&id_reserva='+$('#id_reserva').prop('value')
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
	var id = $(obj).parents('tr').first().prop('id');

	if(confirm('Desea eliminar este objetivo?')){
		$.ajax({
			url: "{{URL::to('objetivo/delete')}}",
			type: 'POST',
			dataType:'json',			 
			data:'id='+id
		})  
		.done(function(json) {
			if(json.success){
				$('tr[id='+id+']').slideUp('slow');							
			}
		})
		.fail(function() {
			console.log("FATAL ERROR: CONTROLLER:OBJETIVO ,ACTION:ELIMINAR");
		});		
	}
}

//funcion mostrar el modal objetivo
function modalUpdate(obj){
	var data = $(obj).parents('tr').first().find('td');
	//asigmanos los datos
	$('input#objetivo').prop('value',data.eq(0).html());
	$('textarea#descripcion').html(data.eq(1).html());
	//agregamos el valor al input hidden necesario para hacer update	
	$('body #idUpdate').prop('value',$(obj).parents('tr').prop('id'));
	//mostramos  el modal y boton update
	$('#modal-header h3').html('Actualizar Objetivos:');
	$('#modalObjetivos input#updateObj').show();
	$('#modalObjetivos input#insertObj').hide();
	$('div#modalObjetivos').modal();

}

//funcion para actualizar reserva
function updateReserva(){
	idTaller  = $('select#id_taller').prop('value');
	idFecha   = $('input#fecha').prop('value');
	idCarrera = $('select#id_carrera').prop('value');
	idAsig    = $('select#id_asig').prop('value');
	idReserva = $('input#id_reserva').prop('value');

	if( idTaller == '' || fecha == '' || idCarrera == '' || idAsig == '' || idReserva == ''){
		alert('debe de llenar todos los datos correctamente');		
	}
	else{
		$.ajax({
			url: "{{URL::to('reserva/update')}}",
			type: 'POST',
			dataType: 'json',
			data: {
				id: idReserva,
				id_taller : idTaller,
				fecha : idFecha,
				id_carrera : idCarrera,
				id_asig: idAsig
			},
		})
		.done(function(data) {
			if(data.success){
				$('div.successUpdate').show('slow').delay(3000).slideUp('slow');
			}
		})
		.fail(function(data) {
			console.log(data);
		});
		
	}


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
			$('div#misobjetivos').html(json.html);
		}
	})
	.fail(function(json) {
		console.log(json);
	});
	
}


$('#modalObjetivos').on('hidden.bs.modal', function () {
	$('#modal-header h3').html('Agregar Objetivos');
	$('#modalObjetivos input#insertObj').show();
	$('#modalObjetivos input#updateObj').hide();		
	  $('form#objetivos').each(function() {
		this.reset();
	  });
	  $('textarea').empty();
})

@if(isset($reserva))
	var dataReserva = {{$reserva->toJson()}};
	var dataHoras   = {{$horas->toJson()}};
	dataReserva = dataReserva[0]; //por comodidad porque siempre se regresa un solo registro
	$('input#id_reserva').prop('value',dataReserva.id); ///importante¡¡¡¡
	$('button#disponible').prop('disabled',true);
	$('#areaUpdate').show();
	$('select#id_taller').prop('value',dataReserva.id_taller);
	$('input#fecha').prop('value',dataReserva.fecha);
	$('select#id_carrera').prop('value',dataReserva.id_carrera);
	$('select#id_asig').prop('value',dataReserva.id_asig);
	$('div#info').delay(5000).slideUp('slow');
	$('#horarios').show().css('opacity','0.8'); //mostramos el div horarios
	$('#horarios button').prop('disabled',true);
	$('input:checkbox').prop('disabled',true).parents('tr').addClass('warning');  //bloqueamos todos los checkbox

	//iteramos los datos de dataHoras
	for(i in dataHoras)
		$('input:checkbox[id='+dataHoras[i].id_horario+']').prop('checked',true).parents('tr').removeClass('warning');

	$('article.alert').hide();
	//cargamos los objetivos de la reserva
	$.ajax({
		url: "{{URL::to('objetivo/objetivos')}}/"+dataReserva.id,
		type: 'GET',
		dataType: 'json'
	})
	.done(function(data) {
		$('div#misobjetivos').html(data.html);
		$('#sectionObj').show();
	})
	.fail(function(data) {
		console.log(data)
	});		
@endif
</script> 
@stop

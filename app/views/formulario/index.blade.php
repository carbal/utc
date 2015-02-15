@extends('layouts.panel')

@section('script')
	@parent
	{{HTML::script('js/validate.js')}}
	{{HTML::script('js/bootstrap-clockpicker.js')}}
	<script type="text/javascript">
		$(function(){


			$('[name="salida"]').clockpicker({
				default:'now',
				toggleView:'minutes',
			    placement: 'right',
			    align: 'left',
			    donetext: 'Salida'
			});
			$('form#formulario').validate({
				ajax:function(form){
					$.ajax({
						url: $(form).attr('action'),
						type:$(form).attr('type'),
						dataType: 'json',
						data: $(form).serialize()
					})
					.done(function(data) {
						if (data.success) {
							$('form').each(function(){
								this.reset();
							});
							$('#success').fadeIn('slow').delay(4000).slideUp('slow');
						}
					})
					.fail(function(data) {
						console.log("error");
					});
					
				}
			});

			$('[name="taller"]').on('keypress',function(event) {
				var _string = this.value;
				var autocomplete = $('div.suggestions')
				autocomplete.slideUp('slow');
				if(_string.length <= 4)
					return;

				$.ajax({
					url: '{{URL::to("formulario/autocomplete")}}',
					type: 'POST',
					dataType: 'json',
					data:{string:_string}
				})
				.done(function(data) {
					if(data.success){
						autocomplete.html(data.html);
						autocomplete.slideDown('slow');
					}
				})
				.fail(function(data) {
					console.log(data);
				});
			});

			$('div.suggestions').on('click','.suggestion',function(){
				$('[name="taller"]').prop('value',$(this).text());
				$('div.suggestions').slideUp('slow');
			})
		})
	</script>
@stop

@section('style')
	@parent
	{{HTML::style('css/bootstrap-clockpicker.css')}}
	<style>
		.suggestions{
			position: absolute;
			z-index: 98;
			background: white;
			width: 90%;
		}
		.suggestions .suggestion{
			margin:0px;
			padding: 0px;
			color: black;
			cursor: pointer;
			text-indent: 10px;
		}
		.suggestions .suggestion:hover{
			background: #428bca;
			color: white;
			text-transform: underline;
		}
	</style>
@stop

@section('contenedor')
	<legend>Encuesta.</legend>
	<div class="alert alert-success" id="success" style="display:none;">
		<p>Encuesta llenada con éxito.</p>
	</div>
	<div class="row">
		<div class="col-md-6">
			<form class="form-horizontal" action="{{URL::to('formulario/insert')}}" type="POST" id="formulario">
				<div class="form-group">
					<label for="" class="control-label col-md-4">Nombres :</label>
					<div class="col-md-6">
						<input name="nombres" type="text" class="required form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-md-4">Apellidos :</label>
					<div class="col-md-6">
						<input name="apellidos" type="text" class="required form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-md-4">Equipo :</label>
					<div class="col-md-6">
						<input name="equipo" type="text" class="required form-control" value="{{gethostname()}}" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-md-4">Taller :</label>
					<div class="col-md-6">
						<input type="text" name="taller" class="required form-control">
						<div class="suggestions" style="display:none;">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-md-4">Hora Salida:</label>
					<div class="col-md-6">
						<div class="input-group clockpicker-with-callbacks">
							<input type="text" name="salida" class="required form-control">
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-time"></span>
							</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-md-4">Comentario :</label>
					<div class="col-md-6">
					<textarea name="comentario" rows="4" class="required form-control col-md-3" style="resize:none;"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-10">
						<button class="btn btn-sm btn-primary pull-right" type="submit">Guardar</button>
					</div>
				</div>
				<input type="hidden" name="fecha"   value="{{date('Y-m-d')}}">
				<input type="hidden" name="entrada" value="{{date('H:i:s')}}">
			</form>
		</div>
		<div class="col-md-6">
			<div class="alert alert-info">
				<p>La hora de entrada es automática por parte del sistema</p>
			</div>
		</div>
	</div>
@stop

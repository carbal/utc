@extends('layouts.admon')

@section('script')
@parent
{{HTML::script('js/underscore.js')}}
{{HTML::script('js/backbone.js')}}
<script type="text/javascript">
	var path = '{{url('/')}}';
	$.fn.serializeObject = function(){
		var o = {};
		var a = this.serializeArray();
		$.each(a, function() {
		 if (o[this.name]) {
		     if (!o[this.name].push) {
		         o[this.name] = [o[this.name]];
		     }
		     o[this.name].push(this.value || '');
		 } else {
		     o[this.name] = this.value || '';
		 }
		});
		return o;
    };

</script>
<script type="text/text-template" id="tmpProfesores">
	<td><%=nombre%></td>
	<td><%=apellido%></td>
	<td><%=password%></td>
	<td><%=tipo%></td>
	<td><span class="glyphicon glyphicon-pencil" id="update"></span></td>
	<td><span class="glyphicon glyphicon-remove" id="delete"></span></td>
</script>
@stop

@section('style')
@parent
@stop

@section('contenedor')
<div class="col-md-8 col-md-offset-2">
	<div class="panel panel-primary" id="profesores">
		  <div class="panel-heading">
				<h3 class="panel-title">PROFESORES.</h3>
		  </div>
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>PROFESOR</th>
					<th>USER</th>
					<th>CONTRASEÑA</th>
					<th>NIVEL</th>
					<th colspan="2">ACCIONES</th>
				</tr>
			</thead>
			<tbody>
			</tbody>

		</table>
		<div class="panel-footer">
			<button class="btn btn-sm btn-primary" id="add">Nuevo</button>
		</div>
	</div>
</div>

<div class="modal fade" id="modalProfesores">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Agregar Nuevo</h4>
			</div>
			<div class="modal-body">
				<form role="form" id="dataProfesor">
					<div class="form-group">
						<input type="text" class="form-control" name="nombre" placeholder="Nombre">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="apellido" placeholder="Apellidos">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="correo" placeholder="Correo">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="nick" placeholder="Nombre usuario">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" name="password" placeholder="Contraseña">
					</div>
					<div class="form-group">
					<label for="tipo">Tipo usuario :</label>
						<div class="checkbox">
							<label>
								<input type="radio" value="profesor" name="tipo" checked>
								Profesor
							</label>	
						</div>
						<div class="checkbox">
							<label>
								<input type="radio" value="admon" name="tipo">
								Administrador
							</label>	
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="add">Agregar</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{{HTML::script('js/profesores.js')}}
@stop
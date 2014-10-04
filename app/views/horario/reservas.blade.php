@if(sizeof($reservas))
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
	  		<th>CARRERA</th>
	  		<th>ASIGNATURA</th>
	  		<th>PROFESOR</th>
	  	</tr>
	  	@foreach($reservas as $reserva)
	  		<tr>
	  			<td>{{$reserva->horario}}</td>
	  			<td>{{$reserva->carrera}}</td>
	  			<td>{{$reserva->asignatura}}</td>
	  			<td>{{$reserva->profesor}}</td>
	  		</tr>
	  	@endforeach
	  </table>
	</div>
@else
	<article class="col-md-10 col-md-offset-1">
		<div class="alert alert-danger">
			<p>No existen resultados para su busqueda.</p>
		</div>
	</article>
@endif
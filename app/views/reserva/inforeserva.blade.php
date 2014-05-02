<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" style="backbround-color:#428bca;">Información sobre la reserva</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered">
						<tr>
							<td class="text-center active" colspan="2">Descripción</td>
						</tr>
						<tr>
							<td>Taller:</td>
							<td>{{$view->taller}}</td>
						</tr>
						<tr>
							<td>Carrera:</td>
							<td>{{$view->carrera}}</td>
						</tr>
						<tr>
							<td>Grupo:</td>
							<td>{{$view->grupo}}</td>
						</tr>
						<tr>
							<td>Asignatura:</td>
							<td>{{$view->asignatura}}</td>
						</tr>
						<tr>
							<td>Fecha:</td>
							<td>{{$view->fecha}}</td>
						</tr>
						<tr>
							<td>Hora:</td>
							<td>{{$view->hora}}</td>
						</tr>
					</table>				
					<table class="table table-bordered">
						<tr class="info">
							<td class="text-center">Horarios</td>
						</tr>
						<tr>							
							<td>
							@foreach($horarios as $horario)
								<span class="label label-info" id="{{$horario->id}}">{{$horario->horario}}</span>
							@endforeach
							</td>
						</tr>
					</table>
					<table class="table table-bordered">
						<tr class="success">
							<th>#</th>
							<th>Objetivo</th>
							<th>Descripcion</th>		
						</tr>
						@foreach($objetivos as $objetivo)
						<tr>
							<td>{{++$contador}}</td>
							<td>{{$objetivo->objetivo}}</td>
							<td>{{$objetivo->descripcion}}</td>
						</tr>
						@endforeach
					</table>
				</div>				
			</div><!-- /.modal-content -->
		</div>

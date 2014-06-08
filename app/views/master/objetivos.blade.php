<table class="table table-bordered">						
<tr>
	<th>Objetivo</th>
	<th>Descripción</th>
	<th colspan="2">Acciones</th>				
</tr>
@foreach($objetivos as $objetivo)							
<tr id="{{$objetivo->id}}">
	<td style="max-width:150px; overflow:hidden;">{{$objetivo->objetivo}}</td>
	<td style="max-width:220px; overflow:hidden;">{{$objetivo->descripcion}}</td>
	<td class="text-center" style="cursor:pointer;"><span class="glyphicon glyphicon-pencil" onclick="modalUpdate(this)"></span></td>
	<td class="text-center" style="cursor:pointer;"><span class="glyphicon glyphicon-remove" onclick="deleteObjetivo(this)"></span></td>	
</tr>						
@endforeach
<tr>
	<td colspan="4">
		<a href="#modalObjetivos" class="btn btn-sm btn-primary pull-right" onclick="$('#modalObjetivos').modal('show');">+Objetivo</a>
	</td>								
</tr>			
</table>


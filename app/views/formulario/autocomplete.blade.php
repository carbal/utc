@if(sizeof($talleres) > 0)
	@foreach($talleres as $taller)
		<div class="suggestion">{{$taller->taller}}.</div>
	@endforeach
@else
	<div class="suggestion">No existen coincidencias.</div>
@endif
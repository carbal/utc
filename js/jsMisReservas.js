
//evento para mostrar información sobre la reserva
function infoReserva(idReserva){

	$.ajax({
		url: "{{URL::to('reserva/inforeserva')}}",
		type: 'POST',
		dataType: 'json',
		data: {
			id: idReserva
		}
	})
	.done(function(json) {
		if(json.success){
			$('div#modalInfo').modal('show');
			$('div#modalInfo div.modal-body').html(json.html);
		}else{
			alert('Hubo un error, por favor notifique al administrador');
		}
	})
	.fail(function(json) {
		console.log(json);
	});
	
}
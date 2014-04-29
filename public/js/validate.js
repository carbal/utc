

$(function(){


	//validacion campo obligatorio
	var required,integer,date;
	var police=false;
	var error=0;
	var errorClass="has-error";
	var successClass="has-success";
	$('form').on('submit', function(event) {
		required=$(this).find('.required');
		required.each( function(){
			if($(this).val()!=""){
				$(this).parent().addClass(successClass);
				$(this).siblings().remove();
			}else{
				$(this).siblings().remove();
				$(this).parent().addClass(errorClass);					
				$(this).after('<span class="error">Campo Requerido</span>');
				error++;
			}
		});

		required.each(function(){
			if($(this).is('input')){

				$(this).on('keyup',function(event) {
					console.log('El campo es input');					
				});
				/*
				$(this).on('keyup', function() {
					if($(this).val().length>4){
						$(this).siblings().fadeIn('slow');
						$(this).addClass(successClass);
					}				
				});
*/
			}
			if($(this).is('select')){
				$(this).on('change', function(event) {
					console.log("cambio");
				});
			}

		});



		if(error>0)
			return false;
		else
			return true;
	});



});
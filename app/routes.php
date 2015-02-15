<?php
//ruta para llenado de formulario
Route::controller('formulario','FormularioController');


//horarios
Route::controller('horario','HorarioController');

//RUTAS PARA LA APLICACIÓN PRINCIPAL|
//evento principales sin enlacar con controlador
//rutas disponibles para usuarios no logueados
//
Route::get('/','InvitadoController@getIndex');

//ruta para autentificar usuario
Route::post('login','Autentificar@entrar');

//ruta para cerrar session
Route::get('logout','Autentificar@salir');
Route::get('bitacora','InvitadoController@getBitacora');
Route::get('validate','InvitadoController@getValidate');
Route::controller('reserva','ReservaController');
Route::controller('profesores','ProfesorController');


//creamos las rutas para el administrador
//aplicamos filtros correspondientes
Route::group(array('before' => 'admon', 'after' => 'admon'), function()
{
	Route::controller('admon','AdmonController');
});


//creamos rutas para los maestros
//aplicamos filtros correspondientes
Route::group(array('before' => 'maestro', 'after' => 'maestro'),function(){
	Route::controller('profesor','MasterController');
	Route::controller('objetivo','ObjetivoController');
});

//routa para todos los errores
App::missing(function($exception){
	return Response::view('notfound', array(), 404);
});

//routa por defecto para los errrores
Route::get('error',function(){
	return View::make('error');
});

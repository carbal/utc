
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


//evento principales sin enlacar con controlador
//rutas disponibles para usuarios no logueados
//
Route::get('/','InvitadoController@getIndex');

//ruta para autentificar usuario
Route::post('login','Autentificar@entrar');
//ruta para cerrar session
Route::get('logout','Autentificar@salir');


//creamos las rutas para el administrador
//aplicamos filtros correspondientes
Route::group(array('before'=>'admon'), function()
{
	Route::controller('admon','AdmonController');
});


//creamos rutas para los maestros
//aplicamos filtros correspondientes
Route::group(array('before'=>'maestro'),function(){
	Route::controller('profesor','MasterController');
	Route::controller('objetivo','ObjetivoController');	
});

//








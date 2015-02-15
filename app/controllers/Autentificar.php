<?php
class Autentificar extends BaseController{

	//método para crear nuevo session para usuario
	public function entrar()
	{
		//capturamos los datos enviados por POST
		$user = Input::get('user');
		$pass = Input::get('pass');
		//realizamos la connsulTa con los datos del usuario

		$user = Profesor::where('nick',$user)
		->where('password',$pass)
		->first();
				
		if(sizeof($user)){
			$periodo = Periodo::all()->last(); //obtenemos el periodo activo
			Session::put('usuario',$user->nombre." ".$user->apellido );
			Session::put('clave',$user->id);
			Session::put('tipo',$user->tipo);
			Session::put('periodo',$periodo->periodo);

			switch ($user->tipo) {
				case 'admon':
					return Redirect::to('admon');
				break;
				case 'profesor':
					return Redirect::to('profesor');
				break;
				default:
					return Redirect::to('/');
				break;
			}
		}else
		{
			return Redirect::to('/')->with('error',true);
		}
	}

	public function salir()
	{
		Session::flush();
		Session::reflash();
		Cache::flush();
		Cookie::forget('laravel_session');
		return Redirect::to('/');
	}
}
?>
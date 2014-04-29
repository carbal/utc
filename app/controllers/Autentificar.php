<?php
class Autentificar extends BaseController{

	//método para crear nuevo session para usuario
	public function entrar()
	{
		//capturamos los datos enviados por POST
		$user=Input::get('user');
		$pass=Input::get('pass');
		//realizamos la connsulTa con los datos del usuario

		$user=DB::table('profesores')
		->where('nick',$user)
		->where('password',$pass)
		->first();
				
		if(count($user)>0){
			Session::put('usuario',$user->nombre." ".$user->apellido );
			Session::put('clave',$user->id);
			Session::put('tipo',$user->tipo);

			if($user->tipo ==='admon')
				return Redirect::to('admon');			
			else
				return Redirect::to('profesor');				
			
			
		}else
		{
			return Redirect::to('/')->with('error',true);
		}
	}

	public function salir()
	{
		Session::flush();
		Cache::flush();
		return Redirect::action('InvitadoController@getIndex');
	}
}
?>
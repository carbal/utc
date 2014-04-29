<?php 
class loginUsuario extends BaseController{
	//método para iniciar session
	public function autentificar()
	{	

		//capturamos los datos enviados por POST
		$datos=Input::all();
		
		//autentificamos
		if(Auth::attempt($datos,true)){
			//obtenemos los valores del usuario y almacenamos en sessiones
			$dataUser=Auth::user();
			Session::put('nombre',$dataUser->Profesor);	
			Session::put('id',$dataUser->Id_Profesor);
			Session::put('nivel',$dataUser->Nivel);
			//Redirigimos a las rutas correctas para cada tipo de usuario
			if(Auth::check() && Session::get('nivel')=='Administrador'){
				return Redirect::to('admon');				
			}
			elseif (Auth::check() && Session::get('tipo')=='Profesor') {
				return Redirect::to('master');
			}
			else{
				return Redirect::to('/');
			}
		}else
		{
			return Redirect::to('/')->with(array('error'=>'error'));
		}
		
	}
	//método para cerrar session
	public function salir()
	{
		Auth::logout();
		Session::forget('username');
		Session::forget('tipo');
		return Redirect::to('/');
	}
}
?>
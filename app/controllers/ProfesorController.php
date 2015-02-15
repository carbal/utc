<?php 
class ProfesorController extends BaseController{

	public function getIndex()
	{
		return View::make('profesor.index');
	}

	public function getNew()
	{
		return View::make('profesor.new');
	}

	public function getProfesores()
	{
		$profesores = Profesor::all();
		return Response::json($profesores);
	}	

	public function postProfesores()
	{
		$profesor = new Profesor();

		$profesor->nombre   = Input::get('nombre');
		$profesor->apellido = Input::get('apellido');
		$profesor->correo   = Input::get('correo');
		$profesor->nick     = Input::get('nick');
		$profesor->password = Input::get('password');
		$profesor->tipo     = Input::get('tipo');
		$profesor->save();

		return Response::json(array('success' => true));
	}

	public function putProfesores($id)
	{
		$profesor = Profesor::find($id);

		$profesor->nombre   = Input::get('nombre');
		$profesor->apellido = Input::get('apellido');
		$profesor->correo   = Input::get('correo');
		$profesor->nick     = Input::get('nick');
		$profesor->password = Input::get('password');
		$profesor->tipo     = Input::get('tipo');

		$profesor->save();
	}

	public function deleteProfesores($id)
	{
		$profesor = Profesor::find($id)->delete();

	}

}

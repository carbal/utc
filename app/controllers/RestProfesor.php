<?

class RestProfesor extends BaseController{


	public function getProfesor()
	{
		$profesores = Profesor::where('tipo','<>',1);
		return Response::json($profesores);
	}

	public function postProfesor()
	{
		
	}
}
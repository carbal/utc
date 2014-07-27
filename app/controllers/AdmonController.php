<?php	
class AdmonController extends BaseController{

	protected $layout="layouts.admon";

	//método para mostrar las vista principal del controlador
	public function getIndex()
	{
		return View::make('admon.index');
	}

	//método para mostrar la vista profesores
	public function getProfesores()
	{	
		//obtenemos a los maestros que no sean administradores
		$profesores = DB::table('profesores')->where('tipo','!=',1)->paginate(10);
		return View::make('admon.profesores',compact('profesores'));
	}

	//método parar mostrar la vista de carreras
	public function getCarreras()
	{
		$carreras = Carrera::paginate(10);
		return View::make('admon.carreras',compact('carreras'));
	}

	//método para mostrar la vista de asignaturas
	public function getAsignaturas()
	{
		$asignaturas = Asignatura::paginate(10);
		return View::make('admon.asignaturas',compact('asignaturas'));
	}


	//método para mostrar  la vista de los talleres
	public function getTalleres()
	{
		$talleres = Taller::all();
		return View::make('admon.talleres',compact('talleres'));

	}

			
}
?>
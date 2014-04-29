<?php
	/**
	*
	*location: App/Controllers/AdmonController.php
	*/

	class AdmonController extends BaseController{

		protected $layout="layouts.admon";

		public function getIndex()
		{
			return $this->layout = View::make('admon.index');
		}

		public function getProfesores()
		{	
			//obtenemos a los maestros que no sean administradores
			$profesores=DB::table('profesores')->where('tipo','!=',1)->paginate(10);
			return $this->layout = View::make('admon.profesores',compact('profesores'));
		}

		public function getAsignaturas()
		{
			$asignaturas = Asignatura::paginate(10);
			return $this->layout = View::make('admon.asignaturas',compact('asignaturas'));
		}

		public function getCarreras()
		{
			$carreras = Carrera::paginate(10);
			return $this->layout = View::make('admon.carreras',compact('carreras'));
		}

		public function getTalleres()
		{
			$talleres=Taller::all();
			return $this->layout = View::make('admon.talleres',compact('talleres'));

		}

				
	}
?>
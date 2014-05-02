
<?php 

/**
*	location: App/Controllers/MasterController.php
*
*/
class MasterController extends BaseController{

	protected $layout = "layouts.master";

	public function getIndex()
	{
		return $this->layout = View::make('master.index');
	}

	public function getReservar()
	{
		//importante si existe la session debe ser detruida
		if(Session::has('lastIdReserva')){
			Session::put('lastIdReserva',NULL);
		}


		$talleres= Taller::all();
		$horarios = horario::all();
		//obtenemos las carreras y asignaturas del maestro para el periodo actual
		$carreras=array();
		$asignaturas=array();
		//array que usaremos como pivote
		$asig=array();


		$cargas = Carga::where('id_profesor',Session::get('clave'))->get();

		if(count($cargas)>0){

			foreach ($cargas as $carga) {

				$carreras[]=$carga->id_carrera;
				$asignaturas[]=$carga->id_asig;								
				$asig[$carga->id_carrera][$carga->id_asig]="";
			}
		}
		//eliminamos id´s repetidos
		$carreras=array_unique($carreras);
		$asignaturas=array_unique($asignaturas);
		//obtenemos las carreras que pertenecen al profesor
		$carreras= Carrera::whereIn('id',$carreras)->get();	
		$asignaturas = Asignatura::whereIn('id',$asignaturas)->get();


		//enviamos los datos a la vista 
		return $this->layout = View::make('master.reservar',compact('talleres','horarios','carreras','asignaturas','asig'));
	}


	public function getMisreservas(){
		$reservas=Viewreserva::where('id_profesor',Session::get('clave'))->get();
		return $this->layout = View::make('master.misreservas',compact('reservas'));
	}	

}
?>
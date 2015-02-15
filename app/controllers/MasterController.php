<?php 
/**
*	location: App/Controllers/MasterController.php
*
*/
class MasterController extends BaseController{

	protected $layout = "layouts.master";

	//mostrar vsita principal de controllador
	public function getIndex()
	{
		return View::make('master.index');
	}

	public function getReservar($id=NULL)
	{

		//importante si existe la session debe ser detruida
		if(Session::has('lastIdReserva'))
			Session::put('lastIdReserva',NULL);

		$talleres = Taller::all();
		$horarios = Horario::all();
		//obtenemos las carreras y asignaturas del maestro para el periodo actual
		$carreras    = array();
		$asignaturas = array();
		//array que usaremos como pivote
		$asig = array();


		$cargas = Carga::where('id_profesor',Session::get('clave'))->get();

		if(count($cargas)>0){
			foreach ($cargas as $carga) {

				$carreras[]    = $carga->id_carrera;
				$asignaturas[] = $carga->id_asig;								
				$asig[$carga->id_carrera][$carga->id_asig]="";
			}
		}
		//eliminamos id´s repetidos
		$carreras    = array_unique($carreras);
		$asignaturas = array_unique($asignaturas);
		//obtenemos las carreras que pertenecen al profesor
		if(!empty($carreras)){
			$carreras    = Carrera::whereIn('id',$carreras)->get();	
			$asignaturas = Asignatura::whereIn('id',$asignaturas)->get();
		}else{
			$carreras    = null;
			$asignaturas = null;
		}


		//dependiendo del parametro del método enviamos datos a la vista
		if($id == NULL)
			$data = compact('talleres','horarios','carreras','asignaturas','asig');
		else{ 
			$reserva = Reserva::where('id',$id)->get();
			$horas   = Detalle::where('id_reserva',$id)->get(); // horas que se hicieron en la
			$data    = compact('talleres','horarios','carreras','asignaturas','asig','reserva','horas');
		}		
		
		return View::make('master.reservar',$data);
	}

	public function getReservas()
	{
		$reservas = Viewreserva::where('id_profesor',Session::get('clave'))->paginate(10);
		return View::make('master.reservas',compact('reservas'));
	}


	//método para mostrar las carreras
	public function getCarreras()
	{	
		return View::make('master.carreras');
	}

}

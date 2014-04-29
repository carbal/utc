
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

	public function postReservafecha()
	{
		if(Request::ajax()){
		
		//capturamos las variables enviadas por ajax
			 $taller= Input::get('taller');
			 $fecha= Input::get('fecha');

			//OBTENEMOS LOS REGISTROS PARA ESE DÍA y TALLER ESPECIFICO
			$reservas = DB::table('reservas')
			->select('reservas.id_taller','detalle_reserva.id_reserva','detalle_reserva.id_horario')			
			->join('detalle_reserva','reservas.id','=','detalle_reserva.id_reserva')
			->where('reservas.id_taller',$taller)
			->where('reservas.fecha',$fecha)
			->get();
			
			return Response::json($reservas);		 

		}else{
			Redirect::to('error');
		}
	}

	public function postInsertreserva()
	{
		if(Request::ajax()){
			$dataAjax=Input::all();
			//obtenemos el periodo actual
			$periodo=Periodo::all()->last();
			//obtenemos los datos faltantes para insertar en la DB
			$data=[
			'id_profesor'=>Session::get('clave'),
			'id_periodo'=>$periodo->id,
			'estado'=>0,
			'hora'=>date('H:i:s')
			];
			//eliminamos el valor json enviado
			unset($dataAjax['jsonhoras']);
			$insert=array_merge($data,$dataAjax);
			//IMPORTANTE:insertamos en la DB y optenemos el ultimo ID
			$idInsert=Reserva::insertGetId($insert);
			//IMPORTANTE ALMACENAMOS EN LA UNA VARIABLE DE SESION EL ID
			if($idInsert){
				Session::put('lastIdReserva',$idInsert);

				//capturamso la variable en json
				$horarios=json_decode(Input::get('jsonhoras'));
				foreach ($horarios as $hora=>$valor) {
					//guardamos en la DB

					Detalle::insert(array(
						'id_reserva'=>Session::get('lastIdReserva'),
						'id_horario'=>$valor
					));
				}

				return Response::json(array('success'=>true));			
			}else{
				return Response::json(array('success'=>false));
			}
		}else{
			Redirect::to('error');
		}
	}

	public function postObjetivo()
	{
		if (Request::ajax()){
			$insert=array(
				'id_reserva'=>Session::get('lastIdReserva'),
				'objetivo'=>Input::get('objetivo'),
				'descripcion'=>Input::get('descripcion'),
				'fecha'=>date('Y-m-d'),
				'hora'=>date('H:m:s')
			);
			Objetivo::insert($insert);

			$objetivos=Objetivo::where('id_reserva',Session::get('lastIdReserva'))->get();
			$vista= View::make('master.objetivos',compact('objetivos'))->render();

			return Response::json(array(
				'success'=>true,
				'html'=>$vista
			));
			
		}else{

		}
	
	}

	public function getPrueba(){
		$objetivos=Objetivo::where('id_reserva',Session::get('lastIdReserva'))->get();
		 return View::make('master.objetivos',compact('objetivos'));

	}

	public function getRespuesta()
	{
		return Session::get('lastIdReserva');
	}

	

}
?>
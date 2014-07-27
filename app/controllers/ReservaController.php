<?php 
class ReservaController extends BaseController{
//funcion para insertar una nueva reserva

	public function getIndex($id)
	{		
		return View::make('reserva.index',compact('id'));
	}

	//método para insertar un nuevo registro
	public function postInsert()
	{
		if(Request::ajax()){
			$dataAjax = Input::all();
			//obtenemos el periodo actual
			$periodo  = Periodo::all()->last();
			//obtenemos los datos faltantes para insertar en la DB
			$data = array(
			'id_profesor' => Session::get('clave'),
			'id_periodo'  => $periodo->id,
			'estado'      => 0,
			'hora'        => date('H:i:s')
			);
			//eliminamos el valor json enviado
			unset($dataAjax['jsonhoras']);

			$insert = array_merge($data,$dataAjax);
			//IMPORTANTE:insertamos en la DB y optenemos el ultimo ID
			$idInsert = Reserva::insertGetId($insert);
			if($idInsert){
				//IMPORTANTE ALMACENAMOS EN LA UNA VARIABLE DE SESION EL ID
				Session::put('lastIdReserva',$idInsert);
				//capturamso la variable en json
				$horarios = json_decode(Input::get('jsonhoras'));
				foreach ($horarios as $hora=>$valor) {
					//guardamos en la DB
					Detalle::insert(array(
						'id_reserva'=>Session::get('lastIdReserva'),
						'id_horario'=>$valor
					));
				}

				return Response::json(array('success' => true));			
			}else{
				return Response::json(array('success' => false));
			}
		}else{
			Redirect::to('error');
		}
	}

	//funcion para obtener los registros de reserva en una fecha especifica
	public function postGetfecha()
	{
		if(Request::ajax()){
		
		//capturamos las variables enviadas por ajax
			 $taller = Input::get('taller');
			 $fecha  = Input::get('fecha');

			//OBTENEMOS LOS REGISTROS PARA ESE DÍA y TALLER ESPECIFICO
			$reservas = DB::table('reservas')
			->select('reservas.id_taller','detalle_reserva.id_reserva','detalle_reserva.id_horario')			
			->join('detalle_reserva','reservas.id','=','detalle_reserva.id_reserva')
			->where('reservas.id_taller',$taller)
			->where('reservas.fecha',$fecha)
			->get();
			
			return Response::json($reservas);		 

		}else{
			return Redirect::to('error');
		}
	}


	//funcion para obtener informacion sobre la reserva
	public function postInfo()
	{
		if(Request::ajax()){
			$id       = Input::get('id');
			$contador = 0;
			//varible
			$horas    = array();
			$view     = Viewreserva::where('id',$id)->first();
			$detalles = Detalle::where('id_reserva',$id)->get();

			foreach($detalles as $detalle){
				array_push($horas,$detalle->id_horario);
			}

			$horarios  = Horario::whereIn('id',$horas)->get();
			$objetivos = Objetivo::where('id_reserva',$id)->get();	
			$view      = View::make('reserva.info',compact('view','horarios','objetivos','contador'))->render();

			return Response::json(array('success' => true,'html' => $view));
		}else{
			return Redirect::to('error');
		}
	}

	//método para actualizar reserva
	public function postUpdate()
	{
		if(Response::ajax()){
			$reserva = Reserva::find(Input::get('id'));
			if($reserva){
				$reserva->id_carrera = Input::get('id_carrera');
				$reserva->id_asig    = Input::get('id_asig');
				$reserva->id_taller  = Input::get('id_taller');
				$reserva->fecha      = Input::get('fecha');
				$reserva->save();

				return Response::json(array('success' => true));
			}
		}else{
			Redirect::to('error');
		}
	}

	public function postBusqueda()
	{
		$fecha  = Input::get('fecha');
		$fecha2 = Input::get('fecha2');
		//die(var_dump($_POST));
		if($fecha2 == NULL || $fecha == ''){
			$reservas =  Viewreserva::where('fecha','=',$fecha)->get();
		}else{
			$reservas =  Viewreserva::whereBetween('fecha',array($fecha,$fecha2))->get();
		}
		$view = View::make('reserva.busqueda',compact('reservas'))->render();
		
		return Response::json(array('success' => true, 'html' => $view));

	}
	//método para cancelar reserva
	public function postCancelar()
	{
		if(Request::ajax()){
			$id      = Input::get('id');
			$reserva = Reserva::find($id);
			if($reserva){
				$reserva->estado = 2;
				$reserva->save();
				return Response::json(array('success' => true));
			}else{
				return Response::json(array('success' => false));
			}

		}else{
			return Redirect::to('error');
		}

	}

	
}

?>
<?
class HorarioController extends BaseController{

	public function getIndex()
	{
		$talleres = Taller::all();
		$_POST['fecha']  = date('Y-m-d');
		$_POST['taller'] = 1;
		$_POST['pivote'] = 1;
		return View::make('horario.index',compact('talleres'));
	}

	public function postReservas()
	{
		$reservas =  DB::table('reservas')
		->join('profesores','profesores.id','=','reservas.id_profesor')
		->join('carreras','carreras.id','=','reservas.id_carrera')
		->join('asignaturas','asignaturas.id','=','reservas.id_asig')
		->join('detalle_reserva','detalle_reserva.id_reserva','=','reservas.id')
		->join('horarios','horarios.id','=','detalle_reserva.id_horario')
		->where('reservas.fecha',Input::get('fecha'))
		->where('reservas.id_taller',Input::get('taller'))
		->orderBy('horarios.id')
		->select(DB::raw('horarios.horario,carreras.carrera,asignaturas.asignatura,CONCAT(profesores.nombre,\' \',profesores.apellido) profesor'))
		->get();
		if(Input::has('pivote'))
			return $reservas;
		else
			return View::make('horario.reservas',compact('reservas'));
	}
}


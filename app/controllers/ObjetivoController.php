<?php 

class ObjetivoController extends BaseController{


	//método para insertar en el modelo 
	public function postInsert()
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
			App::error('404');
		}
	
	}

	//método para  eliminar registro
	public function postDelete(){

		if(Request::ajax()){

			$id=Input::get('id');
			$obj=Objetivo::find($id);
			$obj->delete();
			return  Response::json(array('success'=>true));
		}else{
			App::error('404');
		}
	}

	//método para actualizar registro
	public function postUpdate(){
		
		$objetivo=Objetivo::find(Input::get('id'));

		if($objetivo){
			$objetivo->objetivo   = Input::get('objetivo');
			$objetivo->descripcion= Input::get('descripcion');
			$objetivo->fecha      = date('Y-m-d');
			$objetivo->hora       = date('H:m:s');
			$objetivo->save();

			return Response::json(array('success'=>true));
		}else{
			App::error('404');			
		}

	}

}
 ?>
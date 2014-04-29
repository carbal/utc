<?php 

class ObjetivoController extends BaseController{


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

	public function postUpdate(){

	}

}
 ?>
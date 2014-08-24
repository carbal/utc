<?php 
class FormularioController extends BaseController{


	public function getIndex()
	{
		return View::make('formulario.index');
	}

	public function postInsert()
	{
		Formulario::insert(Input::all());
		return Response::json(array('success' => true));
	}


	public function postAutocomplete()
	{
		if(Request::ajax()){
			$string   = '%'.Input::get('string').'%';
			$talleres = Taller::where('taller','like',$string)->get();
			$view     = View::make('formulario.autocomplete', compact('talleres'))->render();
			return Response::json(array('success' => TRUE, 'html' => $view));
		}
	}

}



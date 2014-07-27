<?php 
class InvitadoController extends BaseController{

	protected $layout="layouts.panel";

	public function getIndex()
	{		
		return $this->layout = View::make('invitado.index');
	}

	
	public function getBitacora()
	{
		$talleres = Taller::all();
		$horarios = Horario::all();
		return $this->layout = View::make('invitado.bitacora',compact('talleres','horarios'));

	}	
}
?>
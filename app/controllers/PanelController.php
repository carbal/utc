<?php 
	/**
	* Location: app/controllers/PanelController.php
	*/
	class PanelController extends BaseController
	{	

		protected $layout = "layouts.panel";

		public function getIndex()
		{
			return $this->layout = View::make('panel.index');
		}	

		public function getReservar()
		{
			return $this->layout = View::make('panel.reservar');
		}	

		public function getHorario()
		{
			return $this->layout = View::make('panel.horario');
		}
	}

 ?>
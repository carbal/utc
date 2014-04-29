<?php 

/*
| Location:app/controllers/ProfesorController.php
|
|
|
*/
class ProfesorController extends BaseController{

	protected $layout="layouts.master";

	public function getIndex()
	{
		$this->layout = View::make('profesor.index');
	}

	public function getNew()
	{
		$this->layout = View::make('profesor.new');
	}

	public function postAdd()
	{
		return "Hola add";
	}

}
?>
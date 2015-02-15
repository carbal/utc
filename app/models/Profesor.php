<?php

class Profesor extends Eloquent
{
	protected $table   = "profesores";
	public $timestamps = FALSE;

	public function cargas()
	{
		return $this->hasMany('Carga','id_profesor');
	}

	public function reservas()
	{
		return $this->hasMany('Reserva','id_profesor');
	}
	
}


<?php 
class Reserva extends Eloquent{

	protected $table   = "reservas";
	public $timestamps = FALSE;

	//reserva pertenece a un profesor
	public function profesor()
	{
		return $this->belongsTo('Profesor');
	}

	//reservas tiene un detalle, relacion uno a uno
	public function detalle()
	{
		return $this->hasOne('Detalle','id_reserva');
	}

	//reservas tiene muchos objetivos, relacion uno a muchos
	public function objetivos()
	{
		return $this->hasMany('Objetivo','id_reserva');
	}
}

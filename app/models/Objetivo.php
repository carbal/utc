<?php 
class Objetivo extends Eloquent{
	protected $table   = 'objetivos';
	public $timestamps = FALSE;

	public function reserva()
	{
		return $this->belongsTo('Reserva');
	}
}

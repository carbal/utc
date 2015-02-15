<?php 
class Detalle extends Eloquent{
	
	protected $table   = 'detalle_reserva';	
	public $timestamps = FALSE;	

	public function reserva()
	{
		return $this->belongsTo('Reserva');
	}
}

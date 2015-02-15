<?php 
class Carga extends Eloquent{
	protected $table   = "cargas";
	public $timestamps = FALSE;

	public function profesor()
	{
		return $this->belongsTo('Profesor');
	}
}

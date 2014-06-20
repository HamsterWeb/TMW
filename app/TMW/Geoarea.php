<?php


class GeoArea extends Eloquent {
	protected $table = 'geoarea';

	public function GeoUnits() {
		return $this->hasMany('GeoUnit', 'geoarea_id');//->select(array('id', 'name', 'geoarea_id'));
	}

}

?>
<?php

class Georegion extends Eloquent {
	protected $table = "georegion";

	public function GeoUnit() {
		return $this->belongsTo('GeoUnit', 'geounit_id');//->select(array('id', 'name', 'geoarea_id'));
	}

	public function getRegion($id){
		return $this->find($id);
	}
	
}

?>
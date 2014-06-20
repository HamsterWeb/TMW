<?php

class Geounit extends Eloquent {
	protected $table = 'geounit';

	public function GeoArea() {
		return $this->belongsTo('GeoArea', 'geoarea_id');//->select(array('id', 'name', 'geoarea_id'));
	}

	public function GeoRegions() {
		return $this->hasMany('GeoRegion', 'geounit_id');//->select(array('id', 'name', 'geoarea_id'));
	}

	public function getRegionsInUnit($unit){
		return $this->find($unit)->GeoRegions;
	}

	public function getUnitBySpot($id){
		
	}

}

?>
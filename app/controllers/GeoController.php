<?php

use TMW\Repositories\GeoAreaRepository\iGeoAreaRepository as GeoArea;
use TMW\Repositories\GeoUnitRepository\iGeoUnitRepository as GeoUnit;
use TMW\Repositories\GeoRegionRepository\iGeoRegionRepository as GeoRegion;


class GeoController extends BaseController
{
	//protected $spots;
	protected $geoarea;
	protected $geounit;
	protected $georegion;

	public function __construct(/*Spot $spots, */GeoArea $geoarea, GeoUnit $geounit, GeoRegion $georegion) {
		//$this->spots = $spots;
		$this->geoarea = $geoarea;
		$this->geounit = $geounit;
		$this->georegion = $georegion;
	}

	public function getAreasWithUnits() {
		$geoareas = $this->geoarea->getIdNameList();
		return $geoareas;
	}

	public function getRegions() {
		if(Request::ajax()) {
			$gr = Input::get('unit');
			$regionArr = $this->geounit->getRegionsInUnit($gr)->lists('name', 'id');
			//$regionArr = array(1 => "ceara");
			return Response::json($regionArr);
			//return $regionArr;
		}
	}

}
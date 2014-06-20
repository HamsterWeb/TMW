<?php
namespace TMW\Repositories\GeoUnitRepository;
use GeoUnit;

class GeoUnitRepository implements iGeoUnitRepository {
	protected $geounit;

	public function __construct(GeoUnit $gu) {
		$this->geounit = $gu;
	}

	public function GeoArea() {
		return $this->geounit->Geoarea();
	}

	public function GeoRegions(){
		return $this->geounit->GeoRegions();
	}

	public function getRegionsInUnit($id = 0) {
		return $this->geounit->getRegionsInUnit($id);
	}

	public function getUnitBySpot($id = 0) {
		return $this->geounit->getIsoCodeBySpot($id);
	}


}
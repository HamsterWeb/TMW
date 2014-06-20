<?php
namespace TMW\Repositories\GeoRegionRepository;
use GeoRegion;

class GeoRegionRepository implements iGeoRegionRepository {

	protected $georegion;

	public function __construct(GeoRegion $gr) {
		$this->georegion = $gr;
	}

	public function getRegion($id = 0){
		if($id != 0)
			return $this->georegion->getRegion($id);
	}

}
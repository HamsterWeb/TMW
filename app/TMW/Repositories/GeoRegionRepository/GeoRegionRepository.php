<?php
namespace TMW\Repositories\GeoRegionRepository;
use GeoRegion;

class GeoRegionRepository implements iGeoRegionRepository {

	public function getList($limit = 0, $skip = 0) {

		return GeoRegion::all()->toArray();

	}

}
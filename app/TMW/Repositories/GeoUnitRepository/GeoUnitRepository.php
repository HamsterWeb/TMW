<?php
namespace TMW\Repositories\GeoUnitRepository;
use GeoUnit;

class GeoUnitRepository implements iGeoUnitRepository {

	public function getList($limit = 0, $skip = 0) {

		return GeoUnit::all()->toArray();

	}

}
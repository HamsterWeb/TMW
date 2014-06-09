<?php
namespace TMW\Repositories\GeoAreaRepository;
use GeoArea;

class GeoAreaRepository implements iGeoAreaRepository {

	public function getList($limit = 0, $skip = 0) {

		return GeoArea::all()->toArray();

	}

}
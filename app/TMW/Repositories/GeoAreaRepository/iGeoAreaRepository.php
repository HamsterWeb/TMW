<?php 
namespace TMW\Repositories\GeoAreaRepository;

interface iGeoAreaRepository {

	public function getList($limit = 0, $skip = 0);

}
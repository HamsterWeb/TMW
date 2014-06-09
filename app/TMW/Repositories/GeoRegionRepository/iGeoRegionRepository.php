<?php 
namespace TMW\Repositories\GeoRegionRepository;

interface iGeoRegionRepository {

	public function getList($limit = 0, $skip = 0);

}
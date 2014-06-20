<?php 
namespace TMW\Repositories\GeoUnitRepository;

interface iGeoUnitRepository {

	//public function getListHavingArea($geoarea_id = 0);

	public function GeoArea();
	public function GeoRegions();
	public function getRegionsInUnit($id = 0);
	public function getUnitBySpot($id = 0);

}
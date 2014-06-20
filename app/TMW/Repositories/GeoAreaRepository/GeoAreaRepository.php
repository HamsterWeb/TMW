<?php
namespace TMW\Repositories\GeoAreaRepository;
use GeoArea;
use DB;

class GeoAreaRepository implements iGeoAreaRepository {

	protected $geoarea;

	public function __construct(GeoArea $ga) {
		$this->geoarea = $ga;
	}

	public function getIdNameList() {
		$unitArr = array();

		$_unitArr = DB::table('geoarea')
						->leftJoin('geoUnit', 'geoarea.id', '=', 'geounit.geoarea_id')
						->select(
							//DB::raw('geoarea.id as ga_id'), 
							DB::raw('geoarea.name  as ga_name'),
							DB::raw('geounit.id as gu_id'), 
							DB::raw('geounit.name as gu_name' )
							)
						->get();

		foreach($_unitArr as $area) {
			foreach($area as $unit) {
				$unitArr[$area['ga_name']][$area['gu_id']] = $area['gu_name'];
			}
			
		}
		//return $this->geoarea->with('GeoUnits')->select('id', 'name')->get();
		//return array_pluck($arr, 'name', 'id');	
		//$queries = DB::getQueryLog();
		//$last_query = end($queries);		
		return $unitArr;
	}

	public function GeoUnits() {
		return $this->geoarea->GeoUnits();
	}

}
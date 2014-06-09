<?php
namespace TMW\Repositories\SpotRepository;
use Spot;

class SpotRepository implements iSpotRepository {

	public function getList($limit = 0, $skip = 0) {

		return Spot::all()->toArray();

	}

	public function getDetail($spot_id = 0) {

	}
}
<?php
namespace TMW\Repositories\RiderRepository;
use Rider;

class RiderRepository implements iRiderRepository {

	public function getList($limit = 0, $skip = 0) {

		return Rider::all()->toArray();

	}

	public function getDetail($Rider_id = 0) {

	}
}
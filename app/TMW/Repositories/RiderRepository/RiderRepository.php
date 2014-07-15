<?php
namespace TMW\Repositories\RiderRepository;
use Rider;

class RiderRepository implements iRiderRepository {

	protected $rider;

	public function __construct(Rider $rider) {
		$this->rider = $rider;
	}

	public function getList($limit = 0, $skip = 0) {
		return Rider::all()->toArray();
	}

	public function getDetail($Rider_id = 0) {

	}

	public function getLoginValidator($input) {
		return $this->rider->getLoginValidator($input);
	}

	public function getRider($id) {
		return $this->rider->getRider($id);
	}

	public function forceLogin($id){
		return $this->rider->forceLogin($id);
	}

}
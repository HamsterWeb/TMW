<?php 
namespace TMW\Repositories\RiderRepository;

interface iRiderRepository {

	public function getList($limit = 0, $skip = 0);

	public function getDetail($Rider_id = 0);
}

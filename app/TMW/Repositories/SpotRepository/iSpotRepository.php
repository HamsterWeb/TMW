<?php 
namespace TMW\Repositories\SpotRepository;

interface iSpotRepository {

	public function getList($limit = 0, $skip = 0);

	public function getDetail($spot_id = 0);
}

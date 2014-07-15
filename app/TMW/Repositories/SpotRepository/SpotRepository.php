<?php
namespace TMW\Repositories\SpotRepository;
use Spot;

class SpotRepository implements iSpotRepository {
	protected $spot;

	public function __construct(Spot $spot) {
		$this->spot = $spot;
	}

	public function getList($limit = 0, $skip = 0) {

		return Spot::all()->toArray();

	}

	public function getNameEvalList($period = 0) {
		return $this->spot->getNameEvalList($period);
	}

	public function checkNameIfExists($name ='', $region = 0){
		return $this->spot->checkNameIfExists($name, $region);
	}

	public function showSpot($id = 0) {
		return $this->spot->showSpot($id);
	}

	public function insertSpot($data = array()) {
		if(!empty($data)){
			return $this->spot->insertSpot($data);
		}
		else
			return false;
	}

	public function setLatLng($id, $lat, $lng){
		return $this->spot->setLatLng($id, $lat, $lng);
	}

	public function editSpot($id = 0, $arrValues = array()) {
		return $this->spot->editSpot($id, $arrValues);
	}

	public function editSpotForPeriod($id = 0, $values = array()){
		return $this->spot->editSpotForPeriod($id, $values);
	}

	public function reviews(){
		return $this->spot->reviews();
	}

}
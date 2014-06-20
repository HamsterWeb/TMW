<?php

class Spot extends Eloquent {
	protected $table = 'spot';


	public function checkNameIfExists ($name, $region){
		return $this->whereRaw("name = '".$name."' and georegion_id = ".$region)->get(array('id', 'name'))->toArray();
	}

	public function showSpot($id) {
		return $this->find($id);
	}

	public function insertSpot($data) {
		$spot = new Spot();
		$spot->name = $data['name'];
		$spot->windsurf = $data['windsurf'];
		$spot->kitesurf = $data['kitesurf'];
		$spot->tide = $data['tide'];
		$spot->waves = $data['waves'];
		$spot->environment = $data['environment'];
		$spot->description = $data['description'];
		$spot->difficulty = $data['difficulty'];
		$spot->advantage = $data['advantage'];
		$spot->disadvantage = $data['disadvantage'];
		$spot->accessibility = $data['accessibility'];
		$spot->windguru_reliable = $data['wg'];
		$spot->georegion_id = $data['georegion'];
		$spot->type_id = $data['water_type'];

		$spot->save();
		return $spot->id;
	}

	public function setLatLng($id, $lat, $lng){
		return $this->where('id', '=', $id)->update(array('latitude' => $lat, 'longitude' => $lng));
	}

	public function editSpot($id, $valuesArr){
		$fields = array();
		foreach($valuesArr as $value){
			$fields[$value['field']] = $value['new_val'];
		}
		return $this->where('id', '=', $id)->update($fields);
	}

}

?>
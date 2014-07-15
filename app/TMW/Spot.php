<?php

class Spot extends Eloquent {
	protected $table = 'spot';


	public function checkNameIfExists ($name, $region){
		return $this->whereRaw("name = '".$name."' and georegion_id = ".$region)->get(array('id', 'name'))->toArray();
	}

	public function showSpot($id) {
		$spot = $this->find($id);
		return $spot->with('GeoRegion', 'GeoRegion.GeoUnit', 'periods', 'reviews', 'reviews.rider', 'reviews.periods')->find($id);;
	}

	public function GeoRegion() {
		return $this->belongsTo('GeoRegion', 'georegion_id');
	}

	public function getNameEvalList($period = 0) {
		$spotsArr = array(array("Spot", "Quality"));
		$curMonth = $period == 0 ? date('n') : $period;
		//$spots = $this->periods()->whereRaw('period_id = '.$curMonth.' and spot_in_period.evaluation > 5')->get(array('name', 'evaluation'));
		//$spots = $this->periods()->where('period_id', '=', $curMonth)->get();
		$spots = DB::table('spot')
						->leftJoin('spot_in_period', 'spot.id', '=', 'spot_in_period.spot_id')
						->whereRaw('period_id = '.$curMonth.' and spot_in_period.evaluation > 5')
						->get(array('spot.name', 'spot.evaluation'));
		/*$spots = $this->with(array('periods' => function($query) use ($curMonth){
			$query->where('period_id', '=', $curMonth);
		}))->get(array('name'));*/
		/*$queries = DB::getQueryLog();
		$last_query = end($queries);	
		return $last_query;*/
		//$spots = $this->get(array('name', 'evaluation'))->toArray();
		foreach($spots as $key=>$value) {
				$spotsArr[] = array($value['name'], (int)$value['evaluation']);
			}
		return $spotsArr;
		//return Spot::lists('evaluation', 'name');
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
		$id = $spot->id;
		$spot->insertSpotForPeriodDefault();
		return $id;
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

	/* periods */
	public function periods(){
		return $this->belongsToMany('Period', 'spot_in_period', 'spot_id', 'period_id')
					->withPivot('temp_water', 'temp_air', 'wind_knots', 'wind_quality', 'wind_percentage', 'weather', 'evaluation', 'wind_direction');
	}

	public function editSpotForPeriod($id, $valuesArr) {
		$fields = array();
		foreach($valuesArr as $value){
			//$fields[$value['field']] = $value['new_val'];
			//$this->periods()->pivot()->whereRaw('spot_id = $id and period_id = '.$value['period'])->update($fields);
			$query = DB::table('spot_in_period')
						->whereRaw('spot_id = '.$id.' and period_id = '.$value['period'])
						->update(array($value['field'] => $value['new_val']));
			if(!$query)
				return false;
		}
		return true;
		/*$queries = DB::getQueryLog();
		$last_query = end($queries);	
		return $last_query;*/
	}

	/*
		insert default values in spot_for_period on spot save
	*/
	public function insertSpotForPeriodDefault() {
		for($i = 1; $i<=12; $i++) {
			$this->periods()->attach($i, array('temp_water'=>0, 'temp_air' => 0, 'wind_quality' => 0, 'wind_percentage' => 0, 'weather' => 0, 'wind_direction' => 0));
		}
	}

	/*public function newPivot(Eloquent $parent, array $attributes, $table, $exists) {
        if ($parent instanceof Period) {
            return new SpotInPeriod($parent, $attributes, $table, $exists);
        }
        return parent::newPivot($parent, $attributes, $table, $exists);
    }*/

    /* comments */
    /* periods */
    /*public function riders(){
    	return $this->belongsToMany('Rider', 'rider_for_spot', 'spot_id', 'rider_id')
    				->withPivot('id', 'title', 'comment', 'date_comment', 'avg_rate');
    					
    }*/

    /*public function comments(){
    	return $this->riders()->orderBy('date_comment', 'desc');//->belongsToMany('Period', 'rider_for_spot_in_period', 'spot_for_period_id', 'period_id');
    }*/

    public function reviews(){
    	return $this->hasMany('Review', 'spot_id')->orderBy('date_comment', 'desc');
    }


}




?>
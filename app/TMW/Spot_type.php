<?php

class Spot_type extends Eloquent {
	protected $table = 'spot_type';

	public function getAll(){
		return $this->lists('name', 'id');
	}

}
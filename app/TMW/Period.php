<?php

class Period extends Eloquent {
	protected $table = 'period';

	public function spots(){
		return $this->belongsToMany('Spot', 'spot_in_period', 'spot_id', 'period_id')->withPivot('water_temp');
	}

	/*public function newPivot(Eloquent $parent, array $attributes, $table, $exists) {
        if ($parent instanceof Spot) {
            return new SpotInPeriod($parent, $attributes, $table, $exists);
        }
        return parent::newPivot($parent, $attributes, $table, $exists);
    }*/

}
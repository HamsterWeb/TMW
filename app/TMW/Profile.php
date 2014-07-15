<?php

class Profile extends Eloquent {

	protected $table = 'social_profile';

    public function rider()
    {
        return $this->belongsTo('Rider');
    }
}
<?php
class Rider extends User {

	protected $table = "rider";

	protected $primaryKey = 'id';

	public function getLoginValidator($input) {
		$rules = array(
					'email' => 'required|exists:rider',
					'password' => 'required'
				);

		$messages = array(
					'email.required' => 'Please provide your email address.',
					'email.exists' => 'Could not find a user registered to the email address.',
					'password' => 'Please provide your password.',
				);
		
		return Validator::make($input, $rules, $messages);
	}

	public function getRider($id) {
		return $this->find($id);
	}
	
	public function forceLogin($id){
		$rider = $this->find($id);
		Auth::login($rider);
	}

	public function spots(){
		return $this->belongsToMany('Spot', 'rider_for_spot', 'spot_id', 'rider_id')->withPivot('id', 'title', 'comment', 'date_comment');
	}

	public function reviews(){
		return $this->hasMany('Review', 'rider_id');
	}

	public function profiles()
	    {
	        return $this->hasMany('Profile');
	    }

}
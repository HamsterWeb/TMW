<?php

class Review extends Eloquent {
	protected $table = 'review';
	

	public function spot() {
		return $this->belongsTo('Spot', 'spot_id');//->select(array('id', 'name', 'geoarea_id'));
	}

	public function rider() {
		return $this->belongsTo('Rider', 'rider_id');//->select(array('id', 'name', 'geoarea_id'));
	}

	/* periods */
	public function periods(){
		return $this->belongsToMany('Period', 'review_for_period', 'review_id', 'period_id')
					->withPivot('evaluation');
	}


    public function reviewValidator($inputs){
    	$rules = array(
    				'title' => 'required|alphaNumCustom',
    				'comment' => 'required|alphaNumCustom'
    			);

    	$messages = array(
    				'title.required' => 'Please provide the title.',
    				'comment.required' => 'Please provide the text for your comment.',
    			);
    	
    	return Validator::make($inputs, $rules, $messages);
    }

    public function insertReview($data){
    	/*$queryId = DB::table('rider_for_spot')
    				->whereRaw('spot_id = '.$data['spot'].' and rider_id = '.$data['rider'])
    				->insertGetId(array(
    						'spot_id' => $data['spot'],
    						'rider_id' => $data['rider'],
	    					'title' => $data['title'], 
	    					'comment' => $data['comment'], 
	    					'date_comment' => date('Y-m-d H:s'),
	    					'avg_rate' => $data['rate']
	    					)
	    				);*/
		$review = new Review();
		$review->spot_id = $data['spot'];
		$review->rider_id = $data['rider'];
		$review->title = $data['title']; 
		$review->comment = $data['comment']; 
		$review->date_comment = date('Y-m-d H:i:s');
		$review->avg_rate = $data['rate'];
		$review->save();

    	if($id = $review->id){
    		$this->insertReviewForPeriod($id, $data['periods']);
    		return true;
    	}
    	else
    		return false;
    	/*$queries = DB::getQueryLog();
    	$last_query = end($queries);	
    	return $last_query;*/

    }

    public function deleteReview($id) {
    	$r = $this->find($id);

    	if($r->delete())
    		return true;
    	else
    		return false;	
    }

    public function insertReviewForPeriod($id, $periods) {
    	$review = $this->find($id);
    	foreach($periods as $p) {
    		$review->periods()->attach($p);
    	}
    }

    /*public function periodsForEval($id){
    	  return DB::table('rider_for_spot_in_period')
    	 			->select('period_id')
    	 			->where('rider_for_spot_id', '=', $id)
    	 			->get();*/

    	/*$queries = DB::getQueryLog();
    	$last_query = end($queries);	
    	return $last_query;*/
    //}

    /*public function insertRiderForSpotInPeriod($id, $periods){
    	foreach($periods as $key=>$value){
    		$query = DB::table('rider_for_spot_in_period')
		    			->insert(array(
		    				'rider_for_spot_id' => $id,
		    				'period_id' => $value
		    				));
		    	if(!$query)
		    		return false;
		    }
		    return true;
    }*/

}
/*use Illuminate\Database\Eloquent\Relations\Pivot;

class SpotInPeriod extends Eloquent {
	protected $table = 'spot_in_period';

	public function periods(){
		return $this->belongsTo('Period');
	}

	public function spots(){
		return $this->belongsTo('Spot');
	}

	public function updateSpot($id, $valuesArr){
		return $this->spots()->find($id);//->updateExistingPivot($valuesArr);
		//return $this->periods();
	}

}*/

<?php
use TMW\Repositories\ReviewRepository\iReviewRepository as Review;


class ReviewController extends BaseController
{
	protected $review;

	public function __construct(Review $review) {
		$this->review = $review;
	}

	public function addReview(){
		$inputArr = Input::get();
		$validator = $this->review->reviewValidator($inputArr);

		if ($validator->passes()) { 
			if($query = $this->review->insertReview($inputArr)) {
				if(Request::ajax()) {
						return Response::json(array('success' => true));
				} else{
						return Response::json(array('success' => false, 'errors' => 'Unable to add your comment'));
				}

			}
		}
		else {
			if(Request::ajax()) {
					//var_dump($validator->messages());
					return Response::json(array('success' => false, 'errors' => $validator->messages()->toArray()));

			} else{
					Redirect::back()->withInput();
			}
		}

	}

	public function deleteReview(){
		$id = Input::get('id');
		if($this->review->deleteReview($id)) {

			if(Request::ajax()) {
					return Response::json(array('success' => true));
			} else{
					return Response::json(array('success' => false));
			}
		}
		else {
			Redirect::back();
		}

	}
}
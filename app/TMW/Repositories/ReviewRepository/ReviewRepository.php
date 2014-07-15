<?php
namespace TMW\Repositories\ReviewRepository;
use Review;

class ReviewRepository implements iReviewRepository {
	protected $review;

	public function __construct(Review $review) {
		$this->review = $review;
	}

	public function reviewValidator($inputs){
		return $this->review->reviewValidator($inputs);
	}

	public function insertReview($data = array()){
		return $this->review->insertReview($data);
	}

	public function deleteReview($id){
		return $this->review->deleteReview($id);
	}

	public function insertReviewForPeriod($id, $periods = array()){
		return $this->review->insertReviewForPeriod($periods);
	}

}
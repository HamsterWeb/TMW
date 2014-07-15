<?php 
namespace TMW\Repositories\ReviewRepository;

interface iReviewRepository {
	public function reviewValidator($inputs);

	public function insertReview($data = array());

	public function deleteReview($id);

	public function insertReviewForPeriod($id, $periods = array());
	
}
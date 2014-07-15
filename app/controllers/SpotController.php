<?php

use TMW\Repositories\SpotRepository\iSpotRepository as Spot;
use TMW\Repositories\GeoAreaRepository\iGeoAreaRepository as GeoArea;
use TMW\Repositories\GeoUnitRepository\iGeoUnitRepository as GeoUnit;
use TMW\Repositories\GeoRegionRepository\iGeoRegionRepository as GeoRegion;
use TMW\Repositories\ReviewRepository\iReviewRepository as Review;


class SpotController extends BaseController
{
	protected $spots;
	protected $geoarea;
	protected $geounit;
	protected $georegion;
	protected $review;

	public function __construct(Spot $spots, GeoArea $geoarea, GeoUnit $geounit, Georegion $georegion, Review $review) {
		$this->spots = $spots;
		$this->geoarea = $geoarea;
		$this->geounit = $geounit;
		$this->georegion = $georegion;
		$this->review = $review;
	}

	public function showIndex()
	{
		//$spots = json_encode($this->spots->getNameEvalList());
		return View::make('spot/index');//->with('spots', $spots);
	}

	public function getSpotPeriod(){
		$period = Input::get('period');
		$spots = json_encode($this->spots->getNameEvalList($period));
		if(Request::ajax()) {
			return Response::json(array('success' => true, 'spots' => $spots));
		} 
		else {
			return $this->showIndex();
		}
	}

	public function showSpot($id)
	{
		$spot = $this->spots->showSpot($id);
		//$comments = $this->spots->comments()->toArray();
		/*$count = $spot->comments->count();
		$comments = $spot->comments->toArray();
		$paged = Paginator::make($comments, $count, 5);*/
		//$georegion = $this->georegion->getRegion($spot->georegion_id);
		//$geounit = $georegion->GeoUnit()->first();
		//return View::make('spot/single')->with('spot', $spot);//->with('comments', $comments);//->with('georegion', $georegion)->with('geounit', $geounit);
		return View::make('spot/single', compact('spot'));
	}

	public function newSpot(){
		$geoarea = $this->geoarea->getIdNameList();
		return View::make('spot/new', compact('geoarea'));
	}

	/* check if spot already exists */
	public function checkNameIfExists(){
		if(Request::ajax()) {
			$name = Input::get('name');
			$region = Input::get('region');
			$spot = $this->spots->checkNameIfExists($name, $region);
			return Response::json($spot);
		}
	}

	public function addSpot(){
		$inputs = array(
			'georegion' => Input::get('georegion'),
			'name' => Input::get('spotname'),
			'windsurf' => Input::get('windsurf'),
			'kitesurf' => Input::get('kitesurf'),
			'waves' => Input::get('waves'),
			'description' => Input::get('description'),
			'tide' => Input::get('tide'),
			'difficulty' => Input::get('difficulty'),
			'water_type' => Input::get('water_type'),
			'environment' => Input::get('environment'),
			'accessibility' => Input::get('accessibility'),
			'wg' => Input::get('wg'),
			'advantage' => Input::get('advantages'),
			'disadvantage' => Input::get('disadvantages')
			);

		$rules = array(
			'georegion' => 'required',
			'spotname' => 'alphaCustom',
			'description' => 'alphaNumCustom',
			'environment' => 'alphaNumCustom',
			'advantage' => 'alphaNumCustom',
			'disadvantage' => 'alphaNumCustom'
			);

		$validator = Validator::make($inputs, $rules);	

		if ( $validator->fails() ) {
			if(Request::ajax()) {
					return Response::json(array('success' => false, 'id' => $validator->getMessageBag()->toArray()));
			} else{
					return Redirect::back()->withInput();
			}

		} else {
			$result = $this->spots->insertSpot($inputs);
			if($result) {
				if(Request::ajax()) {
						return Response::json(array('success' => true, 'id' => $result ));
				} else{
						return Redirect::back()->withInput();
				}
			}
			else {
				if(Request::ajax()) {
					return Response::json(array('success' => false, 'id' => $result));
				} else{
						return Redirect::back()->withInput();
				}
			}
		}
	}

	public function addLatLng() {
		$id = Input::get('id');
		$lat = Input::get('lat');
		$lng = Input::get('lng');

		if($this->spots->setLatLng($id, $lat, $lng)) {
			if(Request::ajax()) {
						return Response::json(array('success' => true ));
				} else{
						return Redirect::back()->withInput();
				}
		}
	}

	public function editSpot($id){
		$valuesArr = Input::get('fields');
		if($this->spots->editSpot($id, $valuesArr)) {
			if(Request::ajax()) {
						return Response::json(array('success' => true ));
				} else{
						return Redirect::back()->withInput();
				}
		}
	}

	public function editSpotForPeriod($id){
		$valuesArr = Input::get('fields');
		if($this->spots->editSpotForPeriod($id, $valuesArr)) {
			if(Request::ajax()) {
						return Response::json(array('success' => true ));
				} else{
						return Redirect::back()->withInput();
				}
		}
	}

}








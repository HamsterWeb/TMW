<?php

use TMW\Repositories\SpotRepository\iSpotRepository as Spot;

class SpotController extends BaseController
{
	protected $spots;

	public function __construct(Spot $spots) {
		$this->spots = $spots;
	}

	public function showIndex()
	{
		$spots = $this->spots->getList();
		return View::make('spot/index', compact('spots'));
	}

	public function showSpot(Spot $spot)
	{
		return View::make('spot/single');
	}

	public function newSpot(){
		$geoarea = Geoarea::all();
		//var_dump($areas);
		return View::make('spot/new', compact('geoarea'));
		//return View::make('spot/new');
	}

	public function addSpot(){
		
	}
}
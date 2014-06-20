<?php

/*
|--------------------------------------------------------------------------
| Custom Rules 
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::filter('birthday', 'BirthdayFilter');

/*Route::get('/', array(
	'before' => 'birthday:16/06',
	function()
	{
		return View::make('hello');
}));*/

Route::model('spot', 'Spot');
Route::model('rider', 'Rider');


/* spots */
Route::get('/', array('as' => 'index', 'uses' => 'SpotController@showIndex'));

Route::get('spot/new', array( 'as' => 'newSpot', 'uses' => 'SpotController@newSpot'));

Route::post('spot/add', array('before' => 'csrf', 'as' => 'addSpot', 'uses' => 'SpotController@addSpot' ));

Route::get('spot/{id}', 'SpotController@showSpot');

Route::post('georegion/find', array('before' => 'csrf', 'as' => 'georegion', 'uses' => 'GeoController@getRegions' ));

Route::post('spot/checkname', array('before' => 'csrf', 'uses' =>'SpotController@checkNameIfExists'));

Route::post('spot/addlatlng', array('before' => 'csrf', 'uses' => 'SpotController@addLatLng'));

Route::post('spot/{id}/edit', array('before' => 'csrf', 'uses' => 'SpotController@editSpot'));


/* users */




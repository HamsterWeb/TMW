<?php

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
Route::get('/', array(
					'as' => 'index',
					'uses' => 'SpotController@showIndex'
					));

Route::get('spot/new', array(
					'as' => 'newSpot',
					'uses' => 'SpotController@newSpot'
					));

Route::get('spot/add', array(
					'as' => 'addSpot',
					'uses' => 'SpotController@addSpot'
			));

Route::get('spot/{spot}', 'SpotController@showSpot');

/* users */




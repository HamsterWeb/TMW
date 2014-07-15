<?php

/* 
-----------------------------
Bindings for repositories 
-----------------------------
*/

App::bind(
	'TMW\Repositories\SpotRepository\iSpotRepository',
	'TMW\Repositories\SpotRepository\SpotRepository'
	);

App::bind(
	'TMW\Repositories\GeoAreaRepository\iGeoAreaRepository',
	'TMW\Repositories\GeoAreaRepository\GeoAreaRepository'
	);

App::bind(
	'TMW\Repositories\GeoUnitRepository\iGeoUnitRepository',
	'TMW\Repositories\GeoUnitRepository\GeoUnitRepository'
	);

App::bind(
	'TMW\Repositories\GeoRegionRepository\iGeoRegionRepository',
	'TMW\Repositories\GeoRegionRepository\GeoRegionRepository'
	);

App::bind(
	'TMW\Repositories\RiderRepository\iRiderRepository',
	'TMW\Repositories\RiderRepository\RiderRepository'
	);

App::bind(
	'TMW\Repositories\ReviewRepository\iReviewRepository',
	'TMW\Repositories\ReviewRepository\ReviewRepository'
	);

/* arrays */

App::bind('water', function(){
	return array('1'=> 'ocean', '2' => 'sea');
	//return Spot_type::getAll();
});

App::bind('wg', function(){
	return array('0'=>'Underestimated', '1' => 'Accurate', '2' => 'Overestimated');
});

App::bind('y-n', function() {
	return array(0 => "No", 1 => "Yes");
});

App::bind('class-color', function(){
	return array(0=> '', 1 => 'success', 2=>'success', 3=>'success', 4=>'success', 5=>'warning', 6=>'warning', 7=>'warning', 8=>'danger', 9=>'danger', 10=>'danger');
});

App::bind('direction', function(){
	return array(0=>'--', 1=>'On', 2=>'Off');
	});

App::bind('quality', function(){
	return array(0=>'--', 1=>'consistent', 2=>'nasty');
});

App::bind('weather', function(){
	return array(0=>'--', 1=>'Sunny', 2=>'Rainy', 3=>'Cloudy');
});

App::bind('period', function(){
	return array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
});

App::bind('level', function(){
	return array(1 => 'beginner', 2 => "intermediate", 3 => "professional", 4 => "instructor");
	});











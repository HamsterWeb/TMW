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
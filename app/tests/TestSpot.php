<?php
require_once 'vendor/phpunit/phpunit/PHPUnit/Framework/Assert/Functions.php';

class TestSpot extends PHPUnit_Framework_TestCase {

	public function testSpotHasPeriods(){
		$spot = new Spot();
		$spot->find(1);
		$this->assertHasMany('periods', 'Spot');
	}
}
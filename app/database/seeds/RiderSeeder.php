<?php

class RiderSeeder extends DatabaseSeeder {
	public function run() {
		$riders = array (
					array(
						'nickname' => 'AdminRider',
						'password' => Hash::make('M@roc14'),
						'email' => 'benoit_dumesnil@yahoo.fr'
					),
					array(
						'nickname' => 'NatChe',
						'password' => Hash::make('M@roc14'),
						'email' => 'ntlchrnv@gmail.com'
						)
				);

		foreach($riders as $rider){
			Rider::create($rider);
		}
	}
}

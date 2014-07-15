<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ToomuchthewindDev extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//geoarea
		Schema::create('geoarea', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name', 128);
			$table->timestamps();
			});

		//geounit
		Schema::create('geounit', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name', 128);
			$table->integer('geoarea_id')->unsigned();
			$table->foreign('geoarea_id')->references('id')->on('geoarea')->onDelete('cascade')->onUpdate('cascade');
			$table->timestamps();
		});

		//georegion
		Schema::create('georegion', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name', 128);
			$table->integer('geounit_id')->unsigned();
			$table->foreign('geounit_id')->references('id')->on('geounit')->onDelete('cascade')->onUpdate('cascade');
			$table->timestamps();
		});

		//spot type
		Schema::create('spot_type', function($table){
			$table->increments('id');
			$table->string('name', 128);
			$table->timestamps();
		});

		//spot
		Schema::create('spot', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('name', 128);
			$table->decimal('longitude', 9, 6);
			$table->decimal('latitude', 9, 6);
			$table->boolean('windsurf');
			$table->boolean('kitesurf');
			$table->integer('evaluation');
			$table->boolean('tide');
			$table->float('waves');
			$table->text('environment');
			$table->text('description');
			$table->integer('difficulty');
			$table->text('advantage');
			$table->text('disadvantage');
			$table->integer('accessibility');
			$table->integer('windguru_reliable');
			$table->integer('hemisphere');
			$table->integer('georegion_id')->unsigned();
			$table->foreign('georegion_id')->references('id')->on('georegion')->onDelete('cascade')->onUpdate('cascade');
			$table->integer('type_id')->unsigned();
			$table->foreign('type_id')->references('id')->on('spot_type')->onDelete('cascade')->onUpdate('cascade');
			$table->timestamps();
		});

		//period
		Schema::create('period', function($table){
			$table->increments('id');
			$table->string('name', 128);
			$table->timestamps();
		});

		//geoarea
		Schema::create('spot_in_period', function($table){
			$table->engine = 'InnoDB';
			$table->integer('spot_id')->unsigned();
			$table->foreign('spot_id')->references('id')->on('spot')->onDelete('cascade')->onUpdate('cascade');
			$table->integer('period_id')->unsigned();
			$table->foreign('period_id')->references('id')->on('period')->onDelete('cascade')->onUpdate('cascade');
			$table->primary(array('spot_id', 'period_id'));
			$table->integer('temp_water');
			$table->integer('temp_air');
			$table->integer('wind_knots');
			$table->integer('wind_quality');
			$table->integer('wind_percentage');
			$table->integer('weather');
			$table->integer('evaluation');
			$table->string('wind_direction', 50);

		});

		//rider
		Schema::create('rider', function($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('firstname', 128);
			$table->string('lastname', 128);
			$table->string('nickname', 128);
			$table->date('birthdate');
			$table->int('geounit_id');
			$table->boolean('kitesurfer');
			$table->boolean('windsurfer');
			$table->integer('k_level');
			$table->integer('w_level');
			$table->string('gender', 10);
			$table->string('email', 128);
			$table->string('password', 256);
			$table->date('k_start');
			$table->date('w_start');
			$table->string("remember_token", 256)->nullable();
			$table->string('app_role', 50);
			$table->string('avatar', 256);
			$table->timestamps();
		});


		//rider_for_spot
		Schema::create('review', function($table){
				$table->engine = 'InnoDB';
				$table->increments('id');
				$table->integer('spot_id')->unsigned();
				$table->foreign('spot_id')->references('id')->on('spot')->onDelete('cascade')->onUpdate('cascade');
				$table->integer('rider_id')->unsigned();
				$table->foreign('rider_id')->references('id')->on('rider')->onDelete('cascade')->onUpdate('cascade');
				$table->text('title');
				$table->text('comment');
				$table->datetime('date_comment');
				$table->float('avg_rate');
				$table->timestamps();
			});

		//rider_for_spot_in_period
		Schema::create('review_for_period', function($table){
				$table->engine = 'InnoDB';
				$table->integer('review_id')->unsigned();
				$table->foreign('review_id')->references('id')->on('review')->onDelete('cascade')->onUpdate('cascade');
				$table->integer('period_id')->unsigned();
				$table->foreign('period_id')->references('id')->on('period')->onDelete('cascade')->onUpdate('cascade');
				$table->integer('evaluation');
			});

		//spot_photo
		Schema::create('spot_photo', function($table){
				$table->engine = 'InnoDB';
				$table->increments('id');
				$table->string('source', 256);
				$table->text('description');
				$table->integer('rider_id')->unsigned();
				$table->foreign('rider_id')->references('id')->on('rider')->onDelete('cascade')->onUpdate('cascade');
				$table->integer('spot_id')->unsigned();
				$table->foreign('spot_id')->references('id')->on('spot')->onDelete('cascade')->onUpdate('cascade');
				$table->timestamps();
				
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//geoarea
		Schema::drop('geoarea');
		Schema::drop('geounit');
		Schema::drop('georegion');
		Schema::drop('spot_type');
		Schema::drop('spot');
		Schema::drop('period');
		Schema::drop('spot_in_period');
		Schema::drop('rider');
		Schema::drop('rider_for_spot');
		Schema::drop('rider_for_spot_in_period');
		Schema::drop('spot_photo');
	}

}

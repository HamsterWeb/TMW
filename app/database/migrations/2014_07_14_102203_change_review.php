<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeReview extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//review
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
		Schema::drop('review_for_period');
		Schema::drop('spot_photo');
	}

}

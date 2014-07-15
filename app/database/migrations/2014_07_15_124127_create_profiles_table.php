<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('social_profile', function($table)
		        {
		            $table->increments('id');
		            $table->integer('rider_id')->unsigned();
		            $table->string('username');
		            $table->biginteger('uid')->unsigned();
		            $table->string('access_token');
		            $table->string('access_token_secret');
		            $table->foreign('rider_id')->references('id')->on('rider')->onDelete('cascade')->onUpdate('cascade');
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
		Schema::drop('social_profile');
	}

}

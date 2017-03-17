<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('venue', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 511)->nullable();
			$table->string('phone', 255)->nullable();
			$table->string('website', 511)->nullable();
			$table->string('description', 2047)->nullable();
			$table->string('suggestion', 2047)->nullable();
			$table->string('address', 511)->nullable();
			$table->string('suburb', 511)->nullable();
			$table->string('city', 511)->nullable();
			$table->string('state', 511)->nullable();
			$table->string('zip_code', 255)->nullable();
			$table->string('country', 255)->nullable();
			$table->string('lattitude', 255)->nullable();
			$table->string('longitude', 255)->nullable();
			$table->string('image_profile', 511)->nullable();
			$table->string('image_suggestion', 511)->nullable();
			$table->string('image_preview', 511)->nullable();
			$table->string('recommendations', 2047)->nullable();
		/*
			$table->time('open_time_monday')->nullable();
			$table->time('open_time_tuesday')->nullable();
			$table->time('open_time_wednesday')->nullable();
			$table->time('open_time_thursday')->nullable();
			$table->time('open_time_friday')->nullable();
			$table->time('open_time_saturday')->nullable();
			$table->time('open_time_sunday')->nullable();
			$table->time('close_time_monday')->nullable();
			$table->time('close_time_tuesday')->nullable();
			$table->time('close_time_wednesday')->nullable();
			$table->time('close_time_thursday')->nullable();
			$table->time('close_time_friday')->nullable();
			$table->time('close_time_saturday')->nullable();
			$table->time('close_time_sunday')->nullable();
		*/

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
		Schema::dropIfExists('venue');
	}

}

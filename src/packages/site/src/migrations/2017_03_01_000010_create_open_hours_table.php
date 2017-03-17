<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpenHoursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('venue_open_hours', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('venue')->references('id')->on('venue');
			$table->string('day', 211);
			$table->time('open_time')->nullable();
			$table->time('close_time')->nullable();
			
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
		Schema::dropIfExists('venue_open_hours');
	}

}

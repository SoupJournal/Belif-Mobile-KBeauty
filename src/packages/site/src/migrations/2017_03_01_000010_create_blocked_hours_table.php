<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockedHoursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('venue_blocked_hours', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('venue')->references('id')->on('venue');
			$table->dateTime('start_date')->nullable();
			$table->dateTime('end_date')->nullable();
			
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
		Schema::dropIfExists('venue_blocked_hours');
	}

}

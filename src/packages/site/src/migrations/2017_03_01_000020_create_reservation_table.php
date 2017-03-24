<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reservation', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user')->references('id')->on('user');
			$table->integer('venue')->references('id')->on('venue');
			$table->timestamp('date');
			$table->integer('guests')->default(1);
			$table->string('code', 255)->unique();
			//$table->string('type', 255)->nullable();
			$table->integer('status')->default(0);

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
		Schema::dropIfExists('reservation');
	}

}

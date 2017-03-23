<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recommendation', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user')->references('id')->on('user');
			$table->integer('venue')->references('id')->on('venue');
			$table->string('type', 255);
			$table->date('activation_date')->nullable();
			$table->date('expiration_date')->nullable();
			
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
		Schema::dropIfExists('recommendation');
	}

}

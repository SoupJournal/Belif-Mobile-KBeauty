<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('review', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('reservation')->unsigned()->unique();
			$table->foreign('reservation')->references('id')->on('reservation');
			//$table->integer('user')->references('id')->on('user');
			//$table->integer('venue')->references('id')->on('venue');
			$table->integer('rating')->default(0);
			$table->string('comment', 1023)->nullable();
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
		Schema::dropIfExists('review');
	}

}

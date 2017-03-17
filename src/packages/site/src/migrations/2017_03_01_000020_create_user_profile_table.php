<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_profile', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user')->references('id')->on('user')->nullable();
			$table->string('question')->references('key')->on('question')->nullable();
			//$table->integer('type')->default(0);
			$table->string('value')->nullable();

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
		Schema::dropIfExists('user_profile');
	}

}

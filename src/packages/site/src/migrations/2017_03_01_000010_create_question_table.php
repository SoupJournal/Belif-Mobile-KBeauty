<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('question', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('type')->default(0);
			$table->string('key', 255)->unique();
			$table->string('group', 255)->nullable();
			$table->string('question', 511)->nullable();
			$table->string('text', 511)->nullable();
			$table->string('options')->nullable();
			$table->string('button', 511)->nullable();
			$table->string('settings')->nullable();
			$table->string('label', 255)->nullable();
			//$table->string('button', 255)->nullable();
			$table->string('background_image', 511)->nullable();
			$table->integer('order')->default(0);
			$table->integer('step')->default(0);
			$table->integer('theme')->default(0);
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
		Schema::dropIfExists('question');
	}

}

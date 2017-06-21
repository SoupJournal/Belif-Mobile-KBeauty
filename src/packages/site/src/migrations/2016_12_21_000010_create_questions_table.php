<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration {

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
			$table->string('name')->nullable();	
			$table->string('question', 1023)->nullable();
			$table->string('text', 1023)->nullable();
			$table->string('correct_answer', 1)->nullable();
			$table->string('answer_A', 1023)->nullable();
			$table->string('answer_B', 1023)->nullable();
			$table->string('answer_C', 1023)->nullable();
			$table->string('video', 1023)->nullable();
			$table->string('question_background_image', 1023)->nullable();
			$table->string('answer_background_image', 1023)->nullable();
			$table->integer('order')->default(0);
			$table->integer('theme')->default(0);
			$table->string('meta_tags')->nullable();
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

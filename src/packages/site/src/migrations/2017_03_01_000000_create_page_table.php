<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('page', function(Blueprint $table)
		{
			$table->increments('id');
			$table->id('parent')->reference('id')->on('page')->nullable();
			$table->string('title')->nullable();
			$table->string('subtitle')->nullable();
			$table->string('text')->nullable();
			$table->string('button')->nullable();
			$table->string('secondary_button')->nullable();
			$table->string('image')->nullable();
			$table->string('background_image')->nullable();
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
		Schema::dropIfExists('page');
	}

}

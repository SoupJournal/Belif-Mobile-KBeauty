<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {

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
			$table->string('key', 255)->unique()->nullable();	
			$table->string('name', 255)->nullable();		
			$table->string('title', 1023)->nullable();
			$table->string('subtitle', 1023)->nullable();
			$table->string('html', 2047)->nullable();
			$table->string('text', 2047)->nullable();
			$table->string('button', 1023)->nullable();
			$table->string('button_cancel', 1023)->nullable();
			$table->string('image', 1023)->nullable();
			$table->string('background_image', 1023)->nullable();
			//$table->integer('order')->default(0);
			$table->string('meta_tags', 1023)->nullable();
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

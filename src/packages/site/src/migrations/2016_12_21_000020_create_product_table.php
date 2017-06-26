<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable();	
			$table->string('description')->nullable();	
			$table->boolean('available')->default(true);
			$table->string('sample_image', 1023)->nullable();
			$table->string('email_image', 1023)->nullable();
			$table->string('email_colour', 15)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('product');
	}

}

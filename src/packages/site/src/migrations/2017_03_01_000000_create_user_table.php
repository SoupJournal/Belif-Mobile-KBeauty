<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name', 255)->nullable();
			$table->string('last_name', 255)->nullable();
			$table->string('phone', 255)->nullable();
			$table->string('email', 255)->unique();
			$table->string('verify_code', 511)->nullable();
			$table->string('address_1', 511)->nullable();
			$table->string('address_2', 511)->nullable();
			$table->string('city', 511)->nullable();
			$table->string('state', 511)->nullable();
			$table->string('zip_code', 255)->nullable();
			$table->date('date_of_birth')->nullable();
			$table->string('photo')->nullable();
			$table->integer('status')->default(0);
			$table->boolean('email_verified')->default(false);
			$table->boolean('unsubscribed')->default(false);
			$table->integer('email_registration_attempts')->default(0);

			$table->string('ip_address', 15)->nullable();

			$table->string('remember_token')->nullable();

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
		Schema::dropIfExists('user');
	}

}

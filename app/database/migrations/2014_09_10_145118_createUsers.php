<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		 Schema::create('users', function($table)
    {
        $table->increments('id');
        $table->string('password', 60);
        $table->string('name',128);
        $table->string('email')->nullable();
        $table->integer('organization');
        $table->rememberToken();
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
		Schema::drop('users');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProposedPosts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 Schema::create('proposedPosts', function($table)
    {
        $table->increments('id');
        $table->string('message');
        $table->integer('user');
        $table->string('picture')->nullable();
        $table->integer('organization');
        $table->timestamps();
        $table->softDeletes();
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('proposedPosts');
	}

}

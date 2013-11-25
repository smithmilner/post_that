<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFlagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('flags', function(Blueprint $table) {
			$table->increments('id');

			$table->integer('user_id')->unsigned()->nullable();
			// $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

			$table->integer('post_id')->unsigned()->nullable();
			// $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
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
		Schema::drop('flags');
	}

}

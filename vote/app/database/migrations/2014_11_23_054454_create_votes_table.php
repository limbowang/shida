<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('players', function($table) {
            $table->increments('id');
            $table->integer('pid');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('votes', function($table) {
            $table->increments('id');
            $table->string('sid', 10);
            $table->string('ip', 15)->nullable();
            $table->integer('pid');
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
		//
        Schema::drop('players');
        Schema::drop('votes');
	}

}

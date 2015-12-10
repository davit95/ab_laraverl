<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTelCountriesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('tel_countries', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->bigInteger('country_code');
				$table->string('full_name');
				$table->string('abbrv');
				$table->bigInteger('logtime');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('tel_countries');
	}
}

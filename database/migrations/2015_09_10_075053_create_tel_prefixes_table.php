<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTelPrefixesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('tel_prefixes', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->bigInteger('country_code');
				$table->bigInteger('prefix');
				$table->bigInteger('logtime');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('tel_prefixes');
	}
}

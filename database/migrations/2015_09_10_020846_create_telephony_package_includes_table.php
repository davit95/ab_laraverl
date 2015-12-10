<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTelephonyPackageIncludesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('telephony_package_includes', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->bigInteger('center_id')->unsigned()->index();
				$table->bigInteger('package_id')->unsigned()->index();
				$table->string('include');
				$table->bigInteger('place');
				/**
				 * Table relations
				 */
				$table->foreign('center_id')->references('id')->on('centers')->onUpdate('restrict')->onDelete('cascade');
				$table->foreign('package_id')->references('id')->on('packages')->onUpdate('restrict')->onDelete('cascade');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('telephony_package_includes');
	}
}

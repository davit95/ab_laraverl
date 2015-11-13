<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_cart_items', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('temp_user_id');
            $table->enum('type', ['mr', 'vo', 'lr']);
            $table->integer('center_id');
            $table->integer('mr_id')->nullable();
            $table->date('mr_date')->nullable();
            $table->time('mr_start_time')->nullable();
            $table->time('mr_end_time')->nullable();
            $table->string('vo_plan')->nullable();
            $table->integer('price');
            $table->string('vo_mail_forwarding_package')->nullable();
            $table->string('vo_mail_forwarding_frequency')->nullable();
            $table->integer('vo_mail_forwarding_price');
            $table->string('vo_mail_forwarding_first_name')->nullable();
            $table->string('vo_mail_forwarding_last_name')->nullable();
            $table->string('vo_mail_forwarding_address_1')->nullable();
            $table->string('vo_mail_forwarding_address_2')->nullable();
            $table->string('vo_mail_forwarding_city')->nullable();
            $table->string('vo_mail_forwarding_country')->nullable();
            $table->boolean('live_receptionist');
            $table->enum('package_option', ['local', 'toll_free']);
            $table->integer('country_code');
            $table->integer('phone_number_selected');
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
        Schema::drop('temp_cart_items');
    }
}

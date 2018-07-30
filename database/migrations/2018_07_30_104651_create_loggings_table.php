<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoggingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loggings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name');
            $table->string('action');
            $table->string('ip');
            $table->string('level');
            $table->string('action_time');
            $table->string('content');
            $table->string('address');
            $table->string('device');
            $table->string('browser');
            $table->string('platform');
            $table->string('language');
            $table->string('device_type');
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
        Schema::dropIfExists('loggings');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *`user_id`, `login_time`, `action`, `ip`, `address`, `device`, `browser`, `platform`, `language`, `device_type`
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('login_time');
            $table->string('action');
            $table->string('ip');
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
        Schema::dropIfExists('logs');
    }
}

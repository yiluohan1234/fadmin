<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analyses', function (Blueprint $table) {
            $table->string('prov_id', 3)->comment('省分ID');
            $table->string('month_id', 6)->comment('月份ID');
            $table->integer('user_num')->comment('用户总数');
            $table->double('total_fee')->comment('用户总消费(M)');
            $table->double('onnet_time_per_user')->comment('用户均在网时长');
            $table->double('dou')->comment('用户总流量(M)');
            $table->double('dou_per_user')->comment('用户均流量(M)');
            $table->double('call_duration_per_user')->comment('用户均通话时长');
            $table->integer('higthv_user_num')->comment('高价值用户总数');
            $table->double('higthv_total_fee')->comment('高价值用户总消费');
            $table->double('higthv_total_fee_per_user')->comment('高价值用户均消费');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analyses');
    }
}

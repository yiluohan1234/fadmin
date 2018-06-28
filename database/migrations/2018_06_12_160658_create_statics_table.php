<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statics', function (Blueprint $table) {
            $table->string('prov_id', 3)->comment('省分ID');
            $table->string('month_id', 6)->comment('月份ID');
            $table->string('service_type', 2)->comment('套餐类型');
            $table->double('user_num')->comment('用户总数');
            $table->double('total_fee')->comment('用户总消费');
            $table->double('onnet_time')->comment('用户总在网时长');
            $table->double('traffic')->comment('用户总流量');
            $table->double('call_duration')->comment('用户总通话时长');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statics');
    }
}

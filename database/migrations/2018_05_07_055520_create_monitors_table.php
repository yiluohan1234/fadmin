<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitors', function (Blueprint $table) {
            $table->string('update_date', 10)->comment('更新时间');
            $table->string('file_type', 10)->comment('文件类型');
            $table->integer('file_num')->comment('更新文件数量');
            $table->double('space_size')->comment('更新文件占用空间（M）');
            $table->double('filesystem_used')->comment('文件系统使用大小');
            $table->double('filesystem_size')->comment('文件系统总大小');
            $table->double('filesystem_use_percentage')->comment('文件系统使用率');
            $table->integer('exec_time')->comment('更新文件所用时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monitors');
    }
}

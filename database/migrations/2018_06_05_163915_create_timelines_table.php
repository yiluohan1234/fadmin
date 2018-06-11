<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimelinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timelines', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('action', ['fa-plus-square', 'fa-bug', 'fa-cloud-upload ', 'fa-trash'])->default('fa-plus-square');
            $table->string('title');
            $table->text('content');
            $table->enum('color', ['bg-green', 'bg-red', 'bg-yellow', 'bg-blue', 'bg-purple'])->default('bg-green');
            $table->date('date');
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
        Schema::dropIfExists('timelines');
    }
}

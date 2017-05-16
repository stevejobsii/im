<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->increments('id');
            // 活动名字
            $table->string('event_name');
            // 活动地点
            $table->integer('event_place');
            // 活动管理员
            $table->integer('manager_id');
            // 活动链接
            $table->integer('event_page_url');
            // 开始时间
            $table->string('start_time');
            // 结束时间
            $table->string('end_time');
            // timestaps
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
        //
    }
}

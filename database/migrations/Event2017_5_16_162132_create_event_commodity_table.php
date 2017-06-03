<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventCommodityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_commodity', function (Blueprint $table) {
            $table->increments('id');
            // 活动名称
            $table->string('event_name');
            // 活动图片
            $table->string('event_img')->nullable();
            // 活动编号
            $table->string('event_number')->nullable();
            // 活动原价
            $table->float('event_original_price')->default(0.00);
            // 活动现价
            $table->float('event_current_price')->default(0.00);
            // 活动库存
            $table->integer('event_stock_number')->default(0);
            // 活动销量
            $table->integer('event_sold_number')->default(0);
            // 活动详情
            $table->text('event_detail_info')->nullable();
            // 活动简介
            $table->string('event_base_info')->nullable();
            // 活动状态
            $table->enum('event_disabled',['已上架','已下架']);
            // 活动排序
            $table->integer('event_sort')->default(0);
            // 所属专题
            //$table->integer('topic_id')->default(0);
            // 所属板块
            //$table->integer('plate_id')->default(0);
            // 所属分类
            $table->integer('category_id')->default(0);

            // 活动开始时间
            $table->string('start_time');
            // 活动结束时间
            $table->string('end_time');
            // 活动地点
            $table->string('event_place');
            // 活动管理员
            $table->string('manager');
            // 活动链接
            $table->string('event_page_url');
            // 活动状态
            $table->enum('status', ['报名中','已报满','已结束']);

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
        Schema::drop('event_commodity');
    }
}

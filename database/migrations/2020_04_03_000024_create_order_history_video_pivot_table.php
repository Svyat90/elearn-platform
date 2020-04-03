<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHistoryVideoPivotTable extends Migration
{
    public function up()
    {
        Schema::create('order_history_video', function (Blueprint $table) {
            $table->unsignedInteger('order_history_id');
            $table->foreign('order_history_id', 'order_history_id_fk_1252715')->references('id')->on('order_histories')->onDelete('cascade');
            $table->unsignedInteger('video_id');
            $table->foreign('video_id', 'video_id_fk_1252715')->references('id')->on('videos')->onDelete('cascade');
        });

    }
}

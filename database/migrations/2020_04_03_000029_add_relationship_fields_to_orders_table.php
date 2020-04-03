<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1252433')->references('id')->on('users');
            $table->unsignedInteger('video_id')->nullable();
            $table->foreign('video_id', 'video_fk_1253238')->references('id')->on('videos');
        });

    }
}

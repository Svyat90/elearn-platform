<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrderHistoriesTable extends Migration
{
    public function up()
    {
        Schema::table('order_histories', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1252714')->references('id')->on('users');
            $table->unsignedInteger('order_id')->nullable();
            $table->foreign('order_id', 'order_fk_1253240')->references('id')->on('orders');
        });

    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPaymentLogsTable extends Migration
{
    public function up()
    {
        Schema::table('payment_logs', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1273082')->references('id')->on('users');
            $table->unsignedInteger('order_id')->nullable();
            $table->foreign('order_id', 'order_fk_1273083')->references('id')->on('orders');
        });

    }
}

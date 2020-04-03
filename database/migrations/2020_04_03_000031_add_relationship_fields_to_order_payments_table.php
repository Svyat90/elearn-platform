<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrderPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('order_payments', function (Blueprint $table) {
            $table->unsignedInteger('order_id')->nullable();
            $table->foreign('order_id', 'order_fk_1252766')->references('id')->on('orders');
        });

    }
}

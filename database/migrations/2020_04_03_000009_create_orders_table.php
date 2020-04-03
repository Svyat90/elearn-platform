<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payment_status')->nullable();
            $table->string('order_status')->nullable();
            $table->string('message')->nullable();
            $table->string('payment_info')->nullable();
            $table->float('total', 15, 2)->nullable();
            $table->timestamps();
        });

    }
}

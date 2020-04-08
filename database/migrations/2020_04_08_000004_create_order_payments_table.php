<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payment_by')->nullable();
            $table->float('booking_amount', 15, 2)->nullable();
            $table->float('recieved_amount', 15, 2)->nullable();
            $table->string('payment_status')->nullable();
            $table->string('pg_txnid')->nullable();
            $table->timestamps();
        });

    }
}

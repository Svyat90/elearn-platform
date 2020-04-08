<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentLogsTable extends Migration
{
    public function up()
    {
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('payment_info')->nullable();
            $table->float('amount', 15, 2)->nullable();
            $table->timestamps();
        });

    }
}

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
            $table->string('message');
            $table->integer('video_for')->nullable();
            $table->string('video_from')->nullable();
            $table->string('from_gender')->nullable();
            $table->string('video_to')->nullable();
            $table->string('to_gender')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('delivery_email')->nullable();
            $table->string('delivery_phone')->nullable();
            $table->integer('hide_video')->nullable();
            $table->string('promo_code')->nullable();
            $table->float('promo_discount', 15, 2)->nullable();
            $table->float('booking_amount', 15, 2)->nullable();
            $table->datetime('booking_datetime')->nullable();
            $table->string('payment_by')->nullable();
            $table->string('order_status')->nullable();
            $table->timestamps();
        });

    }
}

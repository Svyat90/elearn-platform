<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('email_subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email_address')->unique();
            $table->string('status')->nullable();
            $table->datetime('subscribed_on')->nullable();
            $table->datetime('unsubscribed_on')->nullable();
            $table->timestamps();
        });

    }
}

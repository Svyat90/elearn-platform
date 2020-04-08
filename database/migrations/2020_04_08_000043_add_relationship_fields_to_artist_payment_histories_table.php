<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToArtistPaymentHistoriesTable extends Migration
{
    public function up()
    {
        Schema::table('artist_payment_histories', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1273450')->references('id')->on('users');
            $table->unsignedInteger('earn_from_id')->nullable();
            $table->foreign('earn_from_id', 'earn_from_fk_1273451')->references('id')->on('users');
        });

    }
}

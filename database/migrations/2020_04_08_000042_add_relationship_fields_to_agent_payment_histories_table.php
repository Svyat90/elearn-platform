<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAgentPaymentHistoriesTable extends Migration
{
    public function up()
    {
        Schema::table('agent_payment_histories', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1273464')->references('id')->on('users');
            $table->unsignedInteger('earn_from_id')->nullable();
            $table->foreign('earn_from_id', 'earn_from_fk_1273465')->references('id')->on('users');
        });

    }
}

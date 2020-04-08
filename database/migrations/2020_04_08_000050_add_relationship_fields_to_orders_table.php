<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1252433')->references('id')->on('users');
            $table->unsignedInteger('language_id')->nullable();
            $table->foreign('language_id', 'language_fk_1273475')->references('id')->on('languages');
            $table->unsignedInteger('occasion_type_id')->nullable();
            $table->foreign('occasion_type_id', 'occasion_type_fk_1273482')->references('id')->on('occasions');
        });

    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('country_id')->nullable();
            $table->foreign('country_id', 'country_fk_1251750')->references('id')->on('countries');
            $table->unsignedInteger('gender_id')->nullable();
            $table->foreign('gender_id', 'gender_fk_1252072')->references('id')->on('genders');
        });

    }
}

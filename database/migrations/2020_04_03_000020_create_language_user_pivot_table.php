<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguageUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('language_user', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_1251728')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('language_id');
            $table->foreign('language_id', 'language_id_fk_1251728')->references('id')->on('languages')->onDelete('cascade');
        });

    }
}

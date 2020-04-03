<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserUserLanguagePivotTable extends Migration
{
    public function up()
    {
        Schema::create('user_user_language', function (Blueprint $table) {
            $table->unsignedInteger('user_language_id');
            $table->foreign('user_language_id', 'user_language_id_fk_1250557')->references('id')->on('user_languages')->onDelete('cascade');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_1250557')->references('id')->on('users')->onDelete('cascade');
        });

    }
}

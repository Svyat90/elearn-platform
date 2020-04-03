<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguageUserLanguagePivotTable extends Migration
{
    public function up()
    {
        Schema::create('language_user_language', function (Blueprint $table) {
            $table->unsignedInteger('user_language_id');
            $table->foreign('user_language_id', 'user_language_id_fk_1250558')->references('id')->on('user_languages')->onDelete('cascade');
            $table->unsignedInteger('language_id');
            $table->foreign('language_id', 'language_id_fk_1250558')->references('id')->on('languages')->onDelete('cascade');
        });

    }
}

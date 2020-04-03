<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLanguagesTable extends Migration
{
    public function up()
    {
        Schema::create('user_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

    }
}

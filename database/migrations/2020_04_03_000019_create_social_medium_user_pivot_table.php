<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialMediumUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('social_medium_user', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_1251751')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('social_medium_id');
            $table->foreign('social_medium_id', 'social_medium_id_fk_1251751')->references('id')->on('social_media')->onDelete('cascade');
        });

    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVideosTable extends Migration
{
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1252711')->references('id')->on('users');
        });

    }
}

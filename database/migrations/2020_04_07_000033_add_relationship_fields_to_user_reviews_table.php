<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserReviewsTable extends Migration
{
    public function up()
    {
        Schema::table('user_reviews', function (Blueprint $table) {
            $table->unsignedInteger('video_id')->nullable();
            $table->foreign('video_id', 'video_fk_1252082')->references('id')->on('videos');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1252083')->references('id')->on('users');
        });

    }
}

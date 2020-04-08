<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('user_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->longText('review_text')->nullable();
            $table->integer('stars')->nullable();
            $table->string('show_video')->nullable();
            $table->string('review_apporval')->nullable();
            $table->timestamps();
        });

    }
}

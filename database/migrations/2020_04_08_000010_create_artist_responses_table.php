<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistResponsesTable extends Migration
{
    public function up()
    {
        Schema::create('artist_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('artist_action')->nullable();
            $table->string('video_status')->nullable();
            $table->string('artist_note')->nullable();
            $table->datetime('action_update')->nullable();
            $table->datetime('completion_update')->nullable();
            $table->timestamps();
        });

    }
}

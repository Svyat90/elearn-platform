<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistEnquiriesTable extends Migration
{
    public function up()
    {
        Schema::create('artist_enquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('social_media_type')->nullable();
            $table->string('social_media')->nullable();
            $table->integer('social_media_followrs')->nullable();
            $table->longText('note')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });

    }
}

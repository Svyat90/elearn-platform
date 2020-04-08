<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistMetaTable extends Migration
{
    public function up()
    {
        Schema::create('artist_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('display_name')->nullable();
            $table->longText('profile_info')->nullable();
            $table->float('artist_fee', 15, 2)->nullable();
            $table->float('artist_commission', 15, 2)->nullable();
            $table->float('company_commission', 15, 2)->nullable();
            $table->string('order_status_email')->nullable();
            $table->string('url_name')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('social_facebook')->nullable();
            $table->string('social_youtube')->nullable();
            $table->string('social_tiktok')->nullable();
            $table->string('social_snapchat')->nullable();
            $table->string('social_twitter')->nullable();
            $table->string('social_twitch')->nullable();
            $table->string('social_linkedin')->nullable();
            $table->string('artist_status')->nullable();
            $table->timestamps();
        });

    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistMetumTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('artist_metum_tag', function (Blueprint $table) {
            $table->unsignedInteger('artist_metum_id');
            $table->foreign('artist_metum_id', 'artist_metum_id_fk_1273782')->references('id')->on('artist_meta')->onDelete('cascade');
            $table->unsignedInteger('tag_id');
            $table->foreign('tag_id', 'tag_id_fk_1273782')->references('id')->on('tags')->onDelete('cascade');
        });

    }
}

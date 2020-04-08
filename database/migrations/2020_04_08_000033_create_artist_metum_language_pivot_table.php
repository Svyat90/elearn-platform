<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistMetumLanguagePivotTable extends Migration
{
    public function up()
    {
        Schema::create('artist_metum_language', function (Blueprint $table) {
            $table->unsignedInteger('artist_metum_id');
            $table->foreign('artist_metum_id', 'artist_metum_id_fk_1273779')->references('id')->on('artist_meta')->onDelete('cascade');
            $table->unsignedInteger('language_id');
            $table->foreign('language_id', 'language_id_fk_1273779')->references('id')->on('languages')->onDelete('cascade');
        });

    }
}

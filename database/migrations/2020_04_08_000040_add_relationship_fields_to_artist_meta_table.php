<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToArtistMetaTable extends Migration
{
    public function up()
    {
        Schema::table('artist_meta', function (Blueprint $table) {
            $table->unsignedInteger('artist_id')->nullable();
            $table->foreign('artist_id', 'artist_fk_1273776')->references('id')->on('users');
            $table->unsignedInteger('main_catogery_id')->nullable();
            $table->foreign('main_catogery_id', 'main_catogery_fk_1273780')->references('id')->on('categories');
            $table->unsignedInteger('sub_category_id')->nullable();
            $table->foreign('sub_category_id', 'sub_category_fk_1273781')->references('id')->on('sub_categories');
        });

    }
}

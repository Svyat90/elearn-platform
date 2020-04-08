<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserWishlistsTable extends Migration
{
    public function up()
    {
        Schema::table('user_wishlists', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1280134')->references('id')->on('users');
            $table->unsignedInteger('artist_id')->nullable();
            $table->foreign('artist_id', 'artist_fk_1280135')->references('id')->on('artist_meta');
        });

    }
}

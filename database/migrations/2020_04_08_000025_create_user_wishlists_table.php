<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWishlistsTable extends Migration
{
    public function up()
    {
        Schema::create('user_wishlists', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

    }
}

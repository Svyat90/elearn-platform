<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMetaTable extends Migration
{
    public function up()
    {
        Schema::create('user_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('bio')->nullable();
            $table->integer('user_wishlist')->nullable();
            $table->timestamps();
        });

    }
}

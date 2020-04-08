<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserMetaTable extends Migration
{
    public function up()
    {
        Schema::table('user_meta', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1275321')->references('id')->on('users');
        });

    }
}

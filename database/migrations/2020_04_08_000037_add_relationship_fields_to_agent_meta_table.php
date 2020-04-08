<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAgentMetaTable extends Migration
{
    public function up()
    {
        Schema::table('agent_meta', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1273612')->references('id')->on('users');
        });

    }
}

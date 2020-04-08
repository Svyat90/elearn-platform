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
            $table->unsignedInteger('agent_id')->nullable();
            $table->foreign('agent_id', 'agent_fk_1275819')->references('id')->on('users');
        });

    }
}

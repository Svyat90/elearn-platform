<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentMetaTable extends Migration
{
    public function up()
    {
        Schema::create('agent_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

    }
}

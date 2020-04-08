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
            $table->float('agent_commission', 15, 2)->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('agent_status')->nullable();
            $table->date('registered_on')->nullable();
            $table->timestamps();
        });

    }
}

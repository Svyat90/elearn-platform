<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchLogsTable extends Migration
{
    public function up()
    {
        Schema::create('search_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('search_term')->nullable();
            $table->string('search_from')->nullable();
            $table->timestamps();
        });

    }
}

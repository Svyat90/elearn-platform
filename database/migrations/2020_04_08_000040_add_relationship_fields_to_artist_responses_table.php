<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToArtistResponsesTable extends Migration
{
    public function up()
    {
        Schema::table('artist_responses', function (Blueprint $table) {
            $table->unsignedInteger('order_id')->nullable();
            $table->foreign('order_id', 'order_fk_1273588')->references('id')->on('orders');
            $table->unsignedInteger('video_id')->nullable();
            $table->foreign('video_id', 'video_fk_1273591')->references('id')->on('videos');
        });

    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToArtistEnquiriesTable extends Migration
{
    public function up()
    {
        Schema::table('artist_enquiries', function (Blueprint $table) {
            $table->unsignedInteger('artist_id')->nullable();
            $table->foreign('artist_id', 'artist_fk_1275588')->references('id')->on('users');
            $table->unsignedInteger('country_id')->nullable();
            $table->foreign('country_id', 'country_fk_1275595')->references('id')->on('countries');
        });

    }
}

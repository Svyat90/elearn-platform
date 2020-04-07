<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralCommissionsTable extends Migration
{
    public function up()
    {
        Schema::create('referral_commissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_commission')->nullable();
            $table->integer('artist_commission')->nullable();
            $table->integer('agent_commission')->nullable();
            $table->timestamps();
        });

    }
}

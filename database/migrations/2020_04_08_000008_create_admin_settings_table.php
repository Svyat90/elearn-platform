<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('admin_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->float('company_commission', 15, 2)->nullable();
            $table->float('referral_user_commision', 15, 2)->nullable();
            $table->float('referal_artist_commision', 15, 2)->nullable();
            $table->float('referal_agent_commision', 15, 2)->nullable();
            $table->integer('artist_video_show_count_web')->nullable();
            $table->integer('artist_video_show_count_app')->nullable();
            $table->timestamps();
        });

    }
}

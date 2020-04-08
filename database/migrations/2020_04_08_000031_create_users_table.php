<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('referral_code')->nullable();
            $table->string('referred_by')->nullable();
            $table->string('registration_platform')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('ig_token')->nullable();
            $table->string('ig_username')->nullable();
            $table->string('user_status')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('registration_source')->nullable();
            $table->datetime('registered_on')->nullable();
            $table->timestamps();
        });

    }
}

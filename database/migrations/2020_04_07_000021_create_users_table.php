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
            $table->date('dob')->nullable();
            $table->string('position_occupation')->nullable();
            $table->integer('subscribers')->nullable();
            $table->string('bio')->nullable();
            $table->string('referral_code')->nullable();
            $table->string('referred_by')->nullable();
            $table->string('registration_platform')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });

    }
}

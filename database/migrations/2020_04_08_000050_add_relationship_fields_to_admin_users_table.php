<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAdminUsersTable extends Migration
{
    public function up()
    {
        Schema::table('admin_users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')
                ->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');
        });

    }
}

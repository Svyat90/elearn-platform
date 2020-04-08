<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAdminUsersTable extends Migration
{
    public function up()
    {
        Schema::table('admin_users', function (Blueprint $table) {
            $table->unsignedInteger('role_id');
            $table->foreign('role_id', 'role_fk_1272052')->references('id')->on('roles');
        });

    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentRolePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_role', function (Blueprint $table) {
            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id')
                ->references('id')->on('documents')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')
                ->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_role');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentRelatedPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_related', function (Blueprint $table) {
            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id')
                ->references('id')->on('documents')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('related_document_id');
            $table->foreign('related_document_id')
                ->references('id')->on('documents')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unique(['document_id', 'related_document_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_related');
    }
}

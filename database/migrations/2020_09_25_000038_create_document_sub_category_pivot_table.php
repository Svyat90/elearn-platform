<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentSubCategoryPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_sub_category', function (Blueprint $table) {
            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id')
                ->references('id')->on('documents')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('sub_category_id');
            $table->foreign('sub_category_id')
                ->references('id')->on('sub_categories')
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
        Schema::dropIfExists('document_sub_category');
    }
}

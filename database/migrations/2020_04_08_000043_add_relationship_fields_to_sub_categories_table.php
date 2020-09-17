<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSubCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('sub_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id');
            $table->foreign('parent_id')
                ->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');
        });

    }
}

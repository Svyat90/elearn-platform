<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Services\CategoryService;

class CreateSubCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('parent_id');
            $table->foreign('parent_id')
                ->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('name_ru')->nullable();
            $table->string('name_ro')->nullable();
            $table->string('name_en')->nullable();

            $table->enum('access',  CategoryService::getAccessTypes())
                ->default(CategoryService::ACCESS_TYPE_PUBLIC);

            $table->timestamps();
            $table->softDeletes();
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Services\CategoryService;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ru')->nullable();
            $table->string('name_ro')->nullable();
            $table->string('name_en')->nullable();

            $table->enum('access', CategoryService::getAccessTypes())
                ->default(CategoryService::ACCESS_TYPE_PUBLIC);

            $table->timestamps();
            $table->softDeletes();
        });
    }
}

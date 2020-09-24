<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Services\DocumentService;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name_ru', 255)->nullable();
            $table->string('name_ro', 255)->nullable();
            $table->string('name_en', 255)->nullable();
            $table->string('name_issuer_ru', 255)->nullable();
            $table->string('name_issuer_ro', 255)->nullable();
            $table->string('name_issuer_en', 255)->nullable();
            $table->string('topic_ru', 255)->nullable();
            $table->string('topic_ro', 255)->nullable();
            $table->string('topic_en', 255)->nullable();
            $table->string('image_path', 255)->nullable();

            $table->text('description')->nullable();

            $table->enum('access', DocumentService::getAccessTypes())
                ->default(DocumentService::ACCESS_TYPE_PUBLIC);

            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}

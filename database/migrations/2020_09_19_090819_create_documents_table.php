<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Services\DocumentService;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('type', 255)->nullable();
            $table->string('number', 255)->nullable();
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
            $table->string('file_path', 255)->nullable();

            $table->text('description')->nullable();

            $table->enum('status', DocumentService::getStatuses())
                ->default(DocumentService::DOCUMENT_STATUS_INITIAL);

            $table->enum('access', DocumentService::getAccessTypes())
                ->default(DocumentService::DOCUMENT_ACCESS_TYPE_PUBLIC);

            $table->timestamp('approved_at')->nullable();
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
        Schema::dropIfExists('documents');
    }
}

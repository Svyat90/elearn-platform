<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TranslateTypeDocumentInDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->string('type_ru', 255)->after('topic_en')->nullable();
            $table->string('type_ro', 255)->after('type_ru')->nullable();
            $table->string('type_en', 255)->after('type_ro')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->string('type_ru', 255)->nullable();
            $table->dropColumn('type_ru', 'type_ro', 'type_en');
        });
    }
}

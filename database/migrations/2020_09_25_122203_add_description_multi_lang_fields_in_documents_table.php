<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Services\Course\CourseService;

class AddDescriptionMultiLangFieldsInDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->text('description_ru')->nullable();
            $table->text('description_ro')->nullable();
            $table->text('description_en')->nullable();
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
            $table->text('description')->nullable();
            $table->dropColumn([
                'description_ru', 'description_ro', 'description_en'
            ]);
        });
    }
}

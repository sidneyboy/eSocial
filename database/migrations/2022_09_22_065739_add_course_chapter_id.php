<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Exam_questions', function (Blueprint $table) {
            $table->BigInteger('course_chapter_id')->nullable();
            $table->string('question_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Exam_questions', function (Blueprint $table) {
            $table->dropColumn('course_chapter_id')->nullable();
            $table->dropColumn('question_type');
        });
    }
};

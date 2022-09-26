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
        Schema::create('student_logs', function (Blueprint $table) {
            $table->id();
            $table->longText('monday')->nullable();
            $table->longText('tuesday')->nullable();
            $table->longText('wednesday')->nullable();
            $table->longText('thursday')->nullable();
            $table->longText('friday')->nullable();
            $table->longText('saturday')->nullable();
            $table->longText('sunday')->nullable();
            $table->BigInteger('course_id')->nullable();
            $table->BigInteger('course_chapter_id')->nullable();
            $table->BigInteger('assignment_id')->nullable();
            $table->BigInteger('quiz_id')->nullable();
            $table->BigInteger('exam_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_logs');
    }
};

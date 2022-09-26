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
        Schema::create('takens', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('exam_id')->nullable();
            $table->BigInteger('quiz_id')->nullable();
            $table->BigInteger('assignment_id')->nullable();
            $table->BigInteger('instructor_id')->nullable();
            $table->BigInteger('student_id')->nullable();
            $table->BigInteger('course_chapter_id')->nullable();
            $table->BigInteger('course_id')->nullable();
            $table->Integer('score')->nullable();
            $table->Integer('total_points')->nullable();
            $table->string('type')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('takens');
    }
};

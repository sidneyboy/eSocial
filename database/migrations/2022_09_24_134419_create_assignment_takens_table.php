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
        Schema::create('assignment_takens', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('assignment_id');
            $table->BigInteger('instructor_id');
            $table->BigInteger('student_id');
            $table->BigInteger('course_chapter_id');
            $table->BigInteger('course_id');
            $table->Integer('score')->nullable();
            $table->Integer('total_points')->nullable();
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
        Schema::dropIfExists('assignment_takens');
    }
};

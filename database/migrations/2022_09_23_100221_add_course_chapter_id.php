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
        Schema::table('Student_exams', function (Blueprint $table) {
            $table->BigInteger('course_chapter_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Student_exams', function (Blueprint $table) {
            $table->dropColumn('course_chapter_id')->nullable();
        });
    }
};

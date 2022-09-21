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
        Schema::table('Course_quizzes', function (Blueprint $table) {
            $table->string('quiz_title')->nullable();
            $table->Integer('number_of_questions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Course_quizzes', function (Blueprint $table) {
            $table->dropColumn('quiz_title')->nullable();
            $table->dropColumn('number_of_questions')->nullable();
        });
    }
};

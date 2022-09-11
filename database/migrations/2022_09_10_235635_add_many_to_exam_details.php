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
        Schema::table('Exam_details', function (Blueprint $table) {
            $table->longText('question');
            $table->string('answer');
            $table->string('file')->nullable();
            $table->string('file_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Exam_details', function (Blueprint $table) {
            $table->dropColumn('question');
            $table->dropColumn('answer');
            $table->dropColumn('file')->nullable();
            $table->dropColumn('file_type')->nullable();
        });
    }
};

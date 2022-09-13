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
        Schema::table('Student_exam_details', function (Blueprint $table) {
            $table->longText('choice_a');
            $table->longText('choice_b');
            $table->longText('choice_c');
            $table->longText('choice_d');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Student_exam_details', function (Blueprint $table) {
            $table->dropColumn('choice_a');
            $table->dropColumn('choice_b');
            $table->dropColumn('choice_c');
            $table->dropColumn('choice_d');
        });
    }
};

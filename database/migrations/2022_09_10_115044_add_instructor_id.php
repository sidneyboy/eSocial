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
        Schema::table('Direct_messages', function (Blueprint $table) {
            $table->BigInteger('instructor_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Direct_messages', function (Blueprint $table) {
            $table->dropColumn('instructor_id')->nullable();
        });
    }
};

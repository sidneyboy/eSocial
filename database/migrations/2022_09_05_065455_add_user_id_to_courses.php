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
        Schema::table('Courses', function (Blueprint $table) {
            $table->BigInteger('user_id');
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Courses', function (Blueprint $table) {
            $table->BigInteger('user_id');
            $table->dropColumn('status')->nullable();
        });
    }
};

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
        Schema::create('instructor_planners', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('time')->nullable();
            $table->BigInteger('instructor_id');
            $table->longText('todo');
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
        Schema::dropIfExists('instructor_planners');
    }
};

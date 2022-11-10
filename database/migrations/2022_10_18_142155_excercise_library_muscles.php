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
        Schema::create('excercise_library_muscles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('exercise_library_id');
            $table->unsignedBigInteger('excercise_muscle_id');
            $table->foreign('exercise_library_id')->references('id')->on('exercise_libraries')->onDelete('cascade');
            $table->foreign('excercise_muscle_id')->references('id')->on('exercise_muscles')->onDelete('cascade');
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
        Schema::dropIfExists('excercise_library_muscles');
    }
};

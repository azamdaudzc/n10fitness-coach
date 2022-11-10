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
        Schema::create('program_builder_day_exercise_inputs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('day_exercise_id');
            $table->unsignedBigInteger('program_builder_id');
            $table->foreign('day_exercise_id')->references('id')->on('program_builder_day_exercises')->onDelete('cascade');
            $table->foreign('program_builder_id')->references('id')->on('program_builders')->onDelete('cascade');
            $table->integer('set_no')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('reps')->nullable();
            $table->integer('rpe')->nullable();
            $table->integer('peak_exterted_max')->nullable();
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
        Schema::dropIfExists('program_builder_day_exercise_inputs');
    }
};

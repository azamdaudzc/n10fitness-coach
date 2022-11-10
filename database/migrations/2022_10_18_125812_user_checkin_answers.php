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
        Schema::create('user_checkin_answers', function (Blueprint $table) {
            $table->id();
            $table->string('answer');
            $table->unsignedBigInteger('user_checkin_id');
            $table->unsignedBigInteger('checkin_question_input_id');
            $table->unsignedBigInteger('checkin_question_id');
            $table->foreign('user_checkin_id')->references('id')->on('user_checkins')->onDelete('cascade');
            $table->foreign('checkin_question_input_id')->references('id')->on('checkin_question_inputs')->onDelete('cascade');
            $table->foreign('checkin_question_id')->references('id')->on('checkin_questions')->onDelete('cascade');
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
        Schema::dropIfExists('user_checkin_answers');
    }
};

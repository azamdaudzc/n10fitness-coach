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
        Schema::create('checkin_question_inputs', function (Blueprint $table) {
            $table->id();
            $table->string('input_type', 20);
            $table->string('label');
            $table->string('placeholder');
            $table->tinyInteger('is_required');
            $table->integer('display_order')->nullable();
            $table->unsignedBigInteger('checkin_question_id');
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
        Schema::dropIfExists('checkin_question_inputs');
    }
};

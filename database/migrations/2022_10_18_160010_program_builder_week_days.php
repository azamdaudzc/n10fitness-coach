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
        Schema::create('program_builder_week_days', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_builder_week_id');
            $table->foreign('program_builder_week_id')->references('id')->on('program_builder_weeks')->onDelete('cascade');
            $table->string('day_title');
            $table->integer('day_no');
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
        Schema::dropIfExists('program_builder_week_days');
    }
};

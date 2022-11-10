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
        Schema::create('program_builder_weeks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_builder_id');
            $table->foreign('program_builder_id')->references('id')->on('program_builders')->onDelete('cascade');
            $table->integer('week_no');
            $table->integer('assigned_calories')->nullable();
            $table->integer('assigned_proteins')->nullable();
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
        Schema::dropIfExists('program_builder_weeks');
    }
};

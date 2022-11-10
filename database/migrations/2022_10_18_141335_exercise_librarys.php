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
        Schema::create('exercise_libraries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('video_link')->nullable();
            $table->string('avatar')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('equipment_id');
            $table->unsignedBigInteger('movement_pattern_id');
            $table->unsignedBigInteger('created_by');
            $table->foreign('category_id')->references('id')->on('exercise_categories')->onDelete('cascade');
            $table->longText('description')->nullable();
            $table->foreign('equipment_id')->references('id')->on('exercise_equipment')->onDelete('cascade');
            $table->foreign('movement_pattern_id')->references('id')->on('exercise_movement_patterns')->onDelete('cascade');
            $table->text('top_three_cues')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('approved_by')->nullable()->default(0);
            $table->bigInteger('rejected_by')->nullable()->default(0);
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
        Schema::dropIfExists('exercise_libraries');
    }
};

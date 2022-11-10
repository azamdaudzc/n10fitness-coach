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
        Schema::create('program_builder_day_warmups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_builder_week_day_id');
            $table->unsignedBigInteger('warmup_builder_id');
            $table->foreign('program_builder_week_day_id')->references('id')->on('program_builder_week_days')->onDelete('cascade');
            $table->foreign('warmup_builder_id')->references('id')->on('warmup_builders')->onDelete('cascade');
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
        Schema::dropIfExists('program_builder_day_warmups');
    }
};

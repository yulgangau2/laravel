<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayOffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lay_offs', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('no');
            $table->string('position');
            $table->string('first_day');
            $table->string('start_green_at');
            $table->string('end_green_at');
            $table->string('safe_colspan');
            $table->string('start_yellow_at');
            $table->string('end_yellow_at');
            $table->string('warning_colspan');

            $table->string('start_red_at')->nullable();
            $table->string('end_red_at')->nullable();
            $table->string('danger_colspan')->nullable();

            $table->string('exit_at')->nullable();
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
        Schema::dropIfExists('laf_off');
    }
}

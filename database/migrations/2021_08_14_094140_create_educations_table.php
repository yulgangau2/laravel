<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations', function (Blueprint $table) {


            $table->id();
            $table->string('instituteName');
            $table->string('curriculumName')->nullable();
            $table->string('certificateName')->nullable();
            $table->string('major');
            $table->string('educationLevelNameTha')->nullable();
            $table->string('countryNameTha')->nullable();
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
        Schema::dropIfExists('educations');
    }
}

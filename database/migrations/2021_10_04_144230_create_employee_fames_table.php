<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeFamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_fames', function (Blueprint $table) {
            $table->id();
            $table->integer('receiveYear');
            $table->string('referenceDocument');
            $table->string('positionName');
            $table->string('fameNameTha');
            $table->string('receiveReturnStatusName');
            $table->string('classAllType');

            $table->unsignedBigInteger('employee_id')->unsigned();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_fames');
    }
}

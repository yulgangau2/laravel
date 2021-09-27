<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeExecutiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_executive', function (Blueprint $table) {
            $table->id();
            $table->string('employeeAssignDate');
            $table->string('employeeEndDate');
            $table->string('workOnPositionStatusNameTha');
            $table->string('executiveStausName');
            $table->unsignedBigInteger('employee_id')->unsigned();
            $table->unsignedBigInteger('executive_id')->unsigned();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('executive_id')->references('id')->on('executives');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_executive');
    }
}

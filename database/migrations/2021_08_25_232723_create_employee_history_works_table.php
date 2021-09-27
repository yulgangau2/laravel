<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeHistoryWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_history_works', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->string('PositionName');
            $table->string('ReferenceDocumentTypeNameTha')->nullable();
            $table->string('EmployeeAssignDate');
            $table->string('EmployeeEndDate')->nullable();
            $table->float('CurrentSalaryRate');
            $table->string('EmployeeTypeNameTha');
            $table->string('OtherMoney');
            $table->string('Detail');
            $table->integer('priority')->nullable();
            $table->string('OrganizationFullNameTha')->nullable();
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
        Schema::dropIfExists('employee_history_works');
    }
}

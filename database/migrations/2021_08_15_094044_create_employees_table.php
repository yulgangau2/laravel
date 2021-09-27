<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('FullName')->nullable();
            $table->string('PrenameTha')->nullable();
            $table->string('PrenamePositionTha')->nullable();
            $table->string('PositionName')->nullable();
            $table->string('PersonalID')->nullable();
            $table->string('FirstNameTha')->nullable();
            $table->string('FirstNameEng')->nullable();
            $table->string('LastNameTha')->nullable();
            $table->string('LastNameEng')->nullable();
            $table->string('Race')->nullable();
            $table->string('NationalityNameTha')->nullable();
            $table->string('RelegionNameTha')->nullable();
            $table->string('SexNameTha')->nullable();
            $table->string('WorkStatusNameTha')->nullable();
            $table->string('ExitDate')->nullable();
            $table->string('CoupleStatusNameTha')->nullable();
            $table->string('BirthDate')->nullable();
            $table->string('EmailCMU')->nullable();
            $table->string('BloodTypeNameEng')->nullable();
            $table->string('PersonalIDTypeID')->nullable();
            $table->string('MiddleNameEng')->nullable();
            $table->string('MiddleNameTha')->nullable();
            $table->string('CoupleStatusRef')->nullable();
            $table->string('SsoNumber')->nullable();
            $table->string('RdNumber')->nullable();

            $table->string('educationLevelNameTha')->nullable();
            $table->string('HrPositionNumber')->nullable();
            $table->string('CurrentSalaryRate')->nullable();
            $table->string('Type')->nullable();

            $table->integer('changeDate')->default(0); // save new amount
            $table->string('TypeEmployee')->nullable(); // save new amount



            $table->string('FirstWorkDate')->nullable();
            $table->string('InDate')->nullable();
            $table->string('EposDate')->nullable();
            $table->string('EndDate')->nullable();
            $table->string('NewEndDate')->nullable();



            $table->date('DFirstWorkDate')->nullable();
            $table->date('DInDate')->nullable();
            $table->date('DEposDate')->nullable();
            $table->date('DEndDate')->nullable();
            $table->date('DNewEndDate')->nullable();

            $table->string('EmailOther')->nullable();
            $table->string('MobilePhone')->nullable();
            $table->string('HomePhone')->nullable();
            $table->string('OfficePhone')->nullable();
            $table->string('employeeTypeNameTha')->nullable();

//            $table->unsignedBigInteger('education_id')->unsigned()->nullable();
//            $table->unsignedBigInteger('agency_id')->unsigned()->nullable();
//            $table->unsignedBigInteger('position_id')->unsigned()->nullable();
            $table->timestamps();

//            $table->foreign('education_id')->references('id')->on('educations');
//            $table->foreign('agency_id')->references('id')->on('agencies');
//            $table->foreign('position_id')->references('id')->on('positions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}

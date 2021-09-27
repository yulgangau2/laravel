<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{


    public function agency()
    {
        $this->belongsTo(Agency::class,'agency_id','id');
    }

    public function employee_executives()
    {
        return $this->hasMany(EmployeeExecutive::class,'employee_id','id');
    }

    public function employee_educations()
    {
        return $this->hasMany(EmployeeEducation::class,'employee_id','id');
    }

    public function employee_leave_educations()
    {
        return $this->hasMany(EmployeeLeaveEducation::class,'Employee_id','id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class,'position_id','id');
    }


    public function education()
    {
        return $this->belongsTo(Education::class,'education_id','id');
    }

    public function work_histories()
    {
        return $this->hasMany(EmployeeHistoryWork::class,'employee_id','id');
    }
}

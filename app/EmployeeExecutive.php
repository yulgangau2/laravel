<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeExecutive extends Model
{
    protected $table = 'employee_executive';


    public function executive()
    {
       return $this->belongsTo(Executive::class,'executive_id','id');
    }
}

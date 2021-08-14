<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{


    public function agency()
    {
        $this->belongsTo(Agency::class,'agency_id','id');
    }

    public function position()
    {
        $this->belongsTo(Position::class,'position_id','id');
    }


    public function education()
    {
        $this->belongsTo(Education::class,'education_id','id');
    }
}

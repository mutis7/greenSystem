<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExceptionJob extends Model
{
    //
    protected $fillable = ['job_id','house_id', 'description'];

    //one EXception belongs to one job.
     public function job(){
        return $this->belongsTo('App\Job');
    }
    //one EXception belongs to one house.
     public function house(){
        return $this->belongsTo('App\House');
    }
}

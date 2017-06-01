<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
	protected $fillable = ['vehicle_id', 'employee1_id', 'employee2_id', 'employee3_id', 'employee4_id', 'location_id'];

	//one job can have many exceptons 
     public function exceptionJobs(){
        return $this->hasMany('App\ExceptionJob');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class House extends Model
{


	protected $fillable = ['location_id', 'house', 'user_id'];
    //one house is located in one location
    public function location(){
    	return $this->belongsTo('App\Location');
    }

    //one house belongs to one user.
     public function user(){
        return $this->belongsTo('App\User');
    }
    //one house can have many exceptons 
     public function exceptionJobs(){
        return $this->hasMany('App\ExceptionJob');
    }

    //one user can make many payments
     public function payments(){
        return $this->hasMany('App\Payment');
    }
    
   
}

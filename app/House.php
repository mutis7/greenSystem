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
    public function setHouseBalance(){

        //1. get the time the user registered
        //2. get the time now
        //3. get the difference in months
        //4. mutiply the time with the amount per month
        //5. get the total amount the user has ever paid
        //6. subtract and the answer is the balace 
        //7. for now assume the monthly fee is 300
        $activetedAt = $this->attributes['activated_at'];
        $activetedAt = new Carbon($activetedAt);
        $now = Carbon::now();
        $months = $now->diffInMonths($activetedAt);
        $expenses = $months*$this->attributes('monthly_fee');
        $amount = Payment::where('house_id', $this->id)->sum('amount');
        $balance = $amount - $expenses;
        return $balance;
        // dd($balance);


    }

    public static function getHouseBalance(){
       $balance = $this->setHouseBalance();
        return $balance;
    }
}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use App\payment;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'username', 'password', 'role','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $balance=0;

    public function setUsernameAttribute($value){
        $this->attributes['username'] = ucfirst($value);
    }

//encrypt the user password
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

   

    public function setUserBalance(){

        //1. get the time the user registered
        //2. get the time now
        //3. get the difference in months
        //4. mutiply the time with the amount per month
        //5. get the total amount the user has ever paid
        //6. subtract and the answer is the balace 
        //7. for now assume the monthly fee is 300
        $registered = $this->attributes['created_at'];
        $registered = new Carbon($registered);
        $now = Carbon::now();
        $months = $now->diffInMonths($registered);
        $expenses = $months*300.00;
        $amount = Payment::where('user_id', $this->id)->sum('amount');
        $balance = $amount - $expenses;
        return $balance;
        // dd($balance);


    }

    public function getUserBalance(){
       $balance = $this->setUserBalance();
        return $balance;
    }

    //one user can make many payments
     public function payments(){
        return $this->hasMany('App\Payment');
    }

    //one user can make many complaints
     public function complaints(){
        return $this->hasMany('App\Complaint');
    }

    //one user can have many phone numbers
     public function telephones(){
        return $this->hasMany('App\Telephone');
    }

    //one user can have many houses 
     public function houses(){
        return $this->hasMany('App\House');
    }
}


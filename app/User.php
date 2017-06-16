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

      

    //one user can make many complaints
     public function complaints(){
        return $this->hasMany('App\Complaint');
    }

    //one user can have many phone numbers
     public function telephone(){
        return $this->hasOne('App\Telephone');
    }

    //one user can have many houses 
     public function houses(){
        return $this->hasMany('App\House');
    }
}


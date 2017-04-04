<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'telephone_number', 'location', 'house_number', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function setUsernameAttribute($value){
        $this->attributes['username'] = ucfirst($value);
    }

//encrypt the user password
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }
}


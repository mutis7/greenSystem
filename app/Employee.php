<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $fillable = ['idNumber', 'firstName', 'lastName', 'email'];

    //one employee can have many phone numbers
     public function telephones(){
        return $this->hasMany('App\Telephone');
    }
}



<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    
	 protected $fillable = ['county'];
	 
    //one county has many locations
    public function locations(){
        return $this->hasMany('App\Location');
    }


}

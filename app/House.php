<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}

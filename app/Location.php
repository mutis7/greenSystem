<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	
	protected $fillable =['county_id', 'location'];
	//one location belongs to one county
    public function county(){
        return $this->belongsTo('App\County');
    }

    //one location has many houses
    public function houses(){
    	return $this->hasMany('App\House');
    }

}

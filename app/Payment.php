<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //what will be filled in the database
   protected $fillable =['user_id', 'amount'];


	public function user(){
		return $this->belongsTo('App\User');
	}

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //what will be filled in the database
   protected $fillable =['house_id', 'payer', 'amount'];


	public function house(){
		return $this->belongsTo('App\House');
	}

}

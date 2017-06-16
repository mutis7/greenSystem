<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telephone extends Model
{
    //

	protected $fillable = ['telephoneNumber', 'user_id', 'employee_id'];
    public function user(){
		return $this->belongsTo('App\User');
	}

	public function employee(){
		return $this->belongsTo('App\Employee');
	}

	//convert the numbers to begin with +2547
    public function setTelephoneNumberAttribute($value){
    	$numarr =str_split($value); 
		$numarr[0]="+254";
		$tel =implode($numarr);
		$this->attributes['telephoneNumber'] = $tel;
		}
}

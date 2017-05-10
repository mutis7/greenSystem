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
}

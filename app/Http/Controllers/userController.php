<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class userController extends Controller
{
    //
    public function __construct(){
    	$this->middleware('user');
    }

    public function profile(){
    	return "user profile";
    }
}
